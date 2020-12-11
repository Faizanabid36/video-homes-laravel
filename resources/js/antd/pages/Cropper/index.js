"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.default = void 0;

var _jsxRuntime = require("react/jsx-runtime");

var _react = _interopRequireDefault(require("react"));

var _normalizeWheel = _interopRequireDefault(require("normalize-wheel"));

var _helpers = require("./helpers");

var _styles = _interopRequireDefault(require("./styles.css"));

function _interopRequireDefault(obj) {
  return obj && obj.__esModule ? obj : { default: obj };
}

function _defineProperty(obj, key, value) {
  if (key in obj) {
    Object.defineProperty(obj, key, {
      value: value,
      enumerable: true,
      configurable: true,
      writable: true
    });
  } else {
    obj[key] = value;
  }
  return obj;
}

const MIN_ZOOM = 1;
const MAX_ZOOM = 3;

class Cropper extends _react.default.Component {
  constructor(...args) {
    super(...args);

    _defineProperty(this, "imageRef", null);

    _defineProperty(this, "videoRef", null);

    _defineProperty(this, "containerRef", null);

    _defineProperty(this, "styleRef", null);

    _defineProperty(this, "containerRect", null);

    _defineProperty(this, "mediaSize", {
      width: 0,
      height: 0,
      naturalWidth: 0,
      naturalHeight: 0
    });

    _defineProperty(this, "dragStartPosition", {
      x: 0,
      y: 0
    });

    _defineProperty(this, "dragStartCrop", {
      x: 0,
      y: 0
    });

    _defineProperty(this, "lastPinchDistance", 0);

    _defineProperty(this, "lastPinchRotation", 0);

    _defineProperty(this, "rafDragTimeout", null);

    _defineProperty(this, "rafPinchTimeout", null);

    _defineProperty(this, "wheelTimer", null);

    _defineProperty(this, "state", {
      cropSize: null,
      hasWheelJustStarted: false
    });

    _defineProperty(this, "preventZoomSafari", (e) => e.preventDefault());

    _defineProperty(this, "cleanEvents", () => {
      document.removeEventListener("mousemove", this.onMouseMove);
      document.removeEventListener("mouseup", this.onDragStopped);
      document.removeEventListener("touchmove", this.onTouchMove);
      document.removeEventListener("touchend", this.onDragStopped);
    });

    _defineProperty(this, "clearScrollEvent", () => {
      if (this.containerRef)
        this.containerRef.removeEventListener("wheel", this.onWheel);

      if (this.wheelTimer) {
        clearTimeout(this.wheelTimer);
      }
    });

    _defineProperty(this, "onMediaLoad", () => {
      this.computeSizes();
      this.emitCropData();
      this.setInitialCrop();

      if (this.props.onMediaLoaded) {
        this.props.onMediaLoaded(this.mediaSize);
      }
    });

    _defineProperty(this, "setInitialCrop", () => {
      const { initialCroppedAreaPixels, cropSize } = this.props;

      if (!initialCroppedAreaPixels) {
        return;
      }

      const { crop, zoom } = (0, _helpers.getInitialCropFromCroppedAreaPixels)(
        initialCroppedAreaPixels,
        this.mediaSize,
        cropSize
      );
      this.props.onCropChange(crop);
      this.props.onZoomChange && this.props.onZoomChange(zoom);
    });

    _defineProperty(this, "computeSizes", () => {
      const mediaRef = this.imageRef || this.videoRef;

      if (mediaRef && this.containerRef) {
        var _this$imageRef,
          _this$videoRef,
          _this$imageRef2,
          _this$videoRef2,
          _this$state$cropSize,
          _this$state$cropSize2;

        this.containerRect = this.containerRef.getBoundingClientRect();
        this.mediaSize = {
          width: mediaRef.offsetWidth,
          height: mediaRef.offsetHeight,
          naturalWidth:
            ((_this$imageRef = this.imageRef) === null ||
            _this$imageRef === void 0
              ? void 0
              : _this$imageRef.naturalWidth) ||
            ((_this$videoRef = this.videoRef) === null ||
            _this$videoRef === void 0
              ? void 0
              : _this$videoRef.videoWidth) ||
            0,
          naturalHeight:
            ((_this$imageRef2 = this.imageRef) === null ||
            _this$imageRef2 === void 0
              ? void 0
              : _this$imageRef2.naturalHeight) ||
            ((_this$videoRef2 = this.videoRef) === null ||
            _this$videoRef2 === void 0
              ? void 0
              : _this$videoRef2.videoHeight) ||
            0
        };
        const cropSize = this.props.cropSize
          ? this.props.cropSize
          : (0, _helpers.getCropSize)(
              mediaRef.offsetWidth,
              mediaRef.offsetHeight,
              this.containerRect.width,
              this.containerRect.height,
              this.props.aspect,
              this.props.rotation
            );

        if (
          ((_this$state$cropSize = this.state.cropSize) === null ||
          _this$state$cropSize === void 0
            ? void 0
            : _this$state$cropSize.height) !== cropSize.height ||
          ((_this$state$cropSize2 = this.state.cropSize) === null ||
          _this$state$cropSize2 === void 0
            ? void 0
            : _this$state$cropSize2.width) !== cropSize.width
        ) {
          this.props.onCropSizeChange && this.props.onCropSizeChange(cropSize);
        }

        this.setState(
          {
            cropSize
          },
          this.recomputeCropPosition
        );
      }
    });

    _defineProperty(this, "onMouseDown", (e) => {
      e.preventDefault();
      document.addEventListener("mousemove", this.onMouseMove);
      document.addEventListener("mouseup", this.onDragStopped);
      this.onDragStart(Cropper.getMousePoint(e));
    });

    _defineProperty(this, "onMouseMove", (e) =>
      this.onDrag(Cropper.getMousePoint(e))
    );

    _defineProperty(this, "onTouchStart", (e) => {
      e.preventDefault();
      document.addEventListener("touchmove", this.onTouchMove, {
        passive: false
      }); // iOS 11 now defaults to passive: true

      document.addEventListener("touchend", this.onDragStopped);

      if (e.touches.length === 2) {
        this.onPinchStart(e);
      } else if (e.touches.length === 1) {
        this.onDragStart(Cropper.getTouchPoint(e.touches[0]));
      }
    });

    _defineProperty(this, "onTouchMove", (e) => {
      // Prevent whole page from scrolling on iOS.
      e.preventDefault();

      if (e.touches.length === 2) {
        this.onPinchMove(e);
      } else if (e.touches.length === 1) {
        this.onDrag(Cropper.getTouchPoint(e.touches[0]));
      }
    });

    _defineProperty(this, "onDragStart", ({ x, y }) => {
      var _this$props$onInterac, _this$props;

      this.dragStartPosition = {
        x,
        y
      };
      this.dragStartCrop = { ...this.props.crop };
      (_this$props$onInterac = (_this$props = this.props)
        .onInteractionStart) === null || _this$props$onInterac === void 0
        ? void 0
        : _this$props$onInterac.call(_this$props);
    });

    _defineProperty(this, "onDrag", ({ x, y }) => {
      if (this.rafDragTimeout) window.cancelAnimationFrame(this.rafDragTimeout);
      this.rafDragTimeout = window.requestAnimationFrame(() => {
        if (!this.state.cropSize) return;
        if (x === undefined || y === undefined) return;
        const offsetX = x - this.dragStartPosition.x;
        const offsetY = y - this.dragStartPosition.y;
        const requestedPosition = {
          x: this.dragStartCrop.x + offsetX,
          y: this.dragStartCrop.y + offsetY
        };
        const newPosition = this.props.restrictPosition
          ? (0, _helpers.restrictPosition)(
              requestedPosition,
              this.mediaSize,
              this.state.cropSize,
              this.props.zoom,
              this.props.rotation
            )
          : requestedPosition;
        this.props.onCropChange(newPosition);
      });
    });

    _defineProperty(this, "onDragStopped", () => {
      var _this$props$onInterac2, _this$props2;

      this.cleanEvents();
      this.emitCropData();
      (_this$props$onInterac2 = (_this$props2 = this.props)
        .onInteractionEnd) === null || _this$props$onInterac2 === void 0
        ? void 0
        : _this$props$onInterac2.call(_this$props2);
    });

    _defineProperty(this, "onWheel", (e) => {
      e.preventDefault();
      const point = Cropper.getMousePoint(e);
      const { pixelY } = (0, _normalizeWheel.default)(e);
      const newZoom = this.props.zoom - (pixelY * this.props.zoomSpeed) / 200;
      this.setNewZoom(newZoom, point);

      if (!this.state.hasWheelJustStarted) {
        this.setState(
          {
            hasWheelJustStarted: true
          },
          () => {
            var _this$props$onInterac3, _this$props3;

            return (_this$props$onInterac3 = (_this$props3 = this.props)
              .onInteractionStart) === null || _this$props$onInterac3 === void 0
              ? void 0
              : _this$props$onInterac3.call(_this$props3);
          }
        );
      }

      if (this.wheelTimer) {
        clearTimeout(this.wheelTimer);
      }

      this.wheelTimer = window.setTimeout(
        () =>
          this.setState(
            {
              hasWheelJustStarted: false
            },
            () => {
              var _this$props$onInterac4, _this$props4;

              return (_this$props$onInterac4 = (_this$props4 = this.props)
                .onInteractionEnd) === null || _this$props$onInterac4 === void 0
                ? void 0
                : _this$props$onInterac4.call(_this$props4);
            }
          ),
        250
      );
    });

    _defineProperty(this, "getPointOnContainer", ({ x, y }) => {
      if (!this.containerRect) {
        throw new Error("The Cropper is not mounted");
      }

      return {
        x: this.containerRect.width / 2 - (x - this.containerRect.left),
        y: this.containerRect.height / 2 - (y - this.containerRect.top)
      };
    });

    _defineProperty(this, "getPointOnMedia", ({ x, y }) => {
      const { crop, zoom } = this.props;
      return {
        x: (x + crop.x) / zoom,
        y: (y + crop.y) / zoom
      };
    });

    _defineProperty(this, "setNewZoom", (zoom, point) => {
        
      if (!this.state.cropSize || !this.props.onZoomChange) return;
      const zoomPoint = this.getPointOnContainer(point);
      const zoomTarget = this.getPointOnMedia(zoomPoint);
      const newZoom = Math.min(
        this.props.maxZoom,
        Math.max(zoom, this.props.minZoom)
      );
      const requestedPosition = {
        x: zoomTarget.x * newZoom - zoomPoint.x,
        y: zoomTarget.y * newZoom - zoomPoint.y
      };
      const newPosition = this.props.restrictPosition
        ? (0, _helpers.restrictPosition)(
            requestedPosition,
            this.mediaSize,
            this.state.cropSize,
            newZoom,
            this.props.rotation
          )
        : requestedPosition;
      this.props.onCropChange(newPosition);
      this.props.onZoomChange(newZoom);
    });

    _defineProperty(this, "getCropData", () => {
      if (!this.state.cropSize) {
        return null;
      } // this is to ensure the crop is correctly restricted after a zoom back (https://github.com/ricardo-ch/react-easy-crop/issues/6)

      const restrictedPosition = this.props.restrictPosition
        ? (0, _helpers.restrictPosition)(
            this.props.crop,
            this.mediaSize,
            this.state.cropSize,
            this.props.zoom,
            this.props.rotation
          )
        : this.props.crop;
      return (0, _helpers.computeCroppedArea)(
        restrictedPosition,
        this.mediaSize,
        this.state.cropSize,
        this.getAspect(),
        this.props.zoom,
        this.props.rotation,
        this.props.restrictPosition
      );
    });

    _defineProperty(this, "emitCropData", () => {
      const cropData = this.getCropData();
      if (!cropData) return;
      const { croppedAreaPercentages, croppedAreaPixels } = cropData;

      if (this.props.onCropComplete) {
        this.props.onCropComplete(croppedAreaPercentages, croppedAreaPixels);
      }

      if (this.props.onCropAreaChange) {
        this.props.onCropAreaChange(croppedAreaPercentages, croppedAreaPixels);
      }
    });

    _defineProperty(this, "emitCropAreaChange", () => {
      const cropData = this.getCropData();
      if (!cropData) return;
      const { croppedAreaPercentages, croppedAreaPixels } = cropData;

      if (this.props.onCropAreaChange) {
        this.props.onCropAreaChange(croppedAreaPercentages, croppedAreaPixels);
      }
    });

    _defineProperty(this, "recomputeCropPosition", () => {
      if (!this.state.cropSize) return;
      const newPosition = this.props.restrictPosition
        ? (0, _helpers.restrictPosition)(
            this.props.crop,
            this.mediaSize,
            this.state.cropSize,
            this.props.zoom,
            this.props.rotation
          )
        : this.props.crop;
      this.props.onCropChange(newPosition);
      this.emitCropData();
    });
  }

  componentDidMount() {
    window.addEventListener("resize", this.computeSizes);

    if (this.containerRef) {
      this.props.zoomWithScroll &&
        this.containerRef.addEventListener("wheel", this.onWheel, {
          passive: false
        });
      this.containerRef.addEventListener(
        "gesturestart",
        this.preventZoomSafari
      );
      this.containerRef.addEventListener(
        "gesturechange",
        this.preventZoomSafari
      );
    }

    if (!this.props.disableAutomaticStylesInjection) {
      this.styleRef = document.createElement("style");
      this.styleRef.setAttribute("type", "text/css");
      this.styleRef.innerHTML = _styles.default;
      document.head.appendChild(this.styleRef);
    } // when rendered via SSR, the image can already be loaded and its onLoad callback will never be called

    if (this.imageRef && this.imageRef.complete) {
      this.onMediaLoad();
    }
  }

  componentWillUnmount() {
    window.removeEventListener("resize", this.computeSizes);

    if (this.containerRef) {
      this.containerRef.removeEventListener(
        "gesturestart",
        this.preventZoomSafari
      );
      this.containerRef.removeEventListener(
        "gesturechange",
        this.preventZoomSafari
      );
    }

    if (this.styleRef) {
      this.styleRef.remove();
    }

    this.cleanEvents();
    this.props.zoomWithScroll && this.clearScrollEvent();
  }

  componentDidUpdate(prevProps) {
      
    var _prevProps$cropSize,
      _this$props$cropSize,
      _prevProps$cropSize2,
      _this$props$cropSize2,
      _prevProps$crop,
      _this$props$crop,
      _prevProps$crop2,
      _this$props$crop2;

    if (prevProps.rotation !== this.props.rotation) {
      this.computeSizes();
      this.recomputeCropPosition();
    } else if (prevProps.aspect !== this.props.aspect) {
      this.computeSizes();
    } else if (prevProps.zoom !== this.props.zoom) {
      this.recomputeCropPosition();
    } else if (
      ((_prevProps$cropSize = prevProps.cropSize) === null ||
      _prevProps$cropSize === void 0
        ? void 0
        : _prevProps$cropSize.height) !==
        ((_this$props$cropSize = this.props.cropSize) === null ||
        _this$props$cropSize === void 0
          ? void 0
          : _this$props$cropSize.height) ||
      ((_prevProps$cropSize2 = prevProps.cropSize) === null ||
      _prevProps$cropSize2 === void 0
        ? void 0
        : _prevProps$cropSize2.width) !==
        ((_this$props$cropSize2 = this.props.cropSize) === null ||
        _this$props$cropSize2 === void 0
          ? void 0
          : _this$props$cropSize2.width)
    ) {
      this.computeSizes();
    } else if (
      ((_prevProps$crop = prevProps.crop) === null || _prevProps$crop === void 0
        ? void 0
        : _prevProps$crop.x) !==
        ((_this$props$crop = this.props.crop) === null ||
        _this$props$crop === void 0
          ? void 0
          : _this$props$crop.x) ||
      ((_prevProps$crop2 = prevProps.crop) === null ||
      _prevProps$crop2 === void 0
        ? void 0
        : _prevProps$crop2.y) !==
        ((_this$props$crop2 = this.props.crop) === null ||
        _this$props$crop2 === void 0
          ? void 0
          : _this$props$crop2.y)
    ) {
      this.emitCropAreaChange();
    }

    if (
      prevProps.zoomWithScroll !== this.props.zoomWithScroll &&
      this.containerRef
    ) {
      this.props.zoomWithScroll
        ? this.containerRef.addEventListener("wheel", this.onWheel, {
            passive: false
          })
        : this.clearScrollEvent();
    }
  } // this is to prevent Safari on iOS >= 10 to zoom the page

  getAspect() {
    const { cropSize, aspect } = this.props;
    
    if (cropSize) {
      return cropSize.width / cropSize.height;
    }

    return aspect;
  }

  onPinchStart(e) {
    const pointA = Cropper.getTouchPoint(e.touches[0]);
    const pointB = Cropper.getTouchPoint(e.touches[1]);
    this.lastPinchDistance = (0, _helpers.getDistanceBetweenPoints)(
      pointA,
      pointB
    );
    this.lastPinchRotation = (0, _helpers.getRotationBetweenPoints)(
      pointA,
      pointB
    );
    this.onDragStart((0, _helpers.getCenter)(pointA, pointB));
  }

  onPinchMove(e) {
    const pointA = Cropper.getTouchPoint(e.touches[0]);
    const pointB = Cropper.getTouchPoint(e.touches[1]);
    const center = (0, _helpers.getCenter)(pointA, pointB);
    this.onDrag(center);
    if (this.rafPinchTimeout) window.cancelAnimationFrame(this.rafPinchTimeout);
    this.rafPinchTimeout = window.requestAnimationFrame(() => {
      const distance = (0, _helpers.getDistanceBetweenPoints)(pointA, pointB);
      const newZoom = this.props.zoom * (distance / this.lastPinchDistance);
      this.setNewZoom(newZoom, center);
      this.lastPinchDistance = distance;
      const rotation = (0, _helpers.getRotationBetweenPoints)(pointA, pointB);
      const newRotation =
        this.props.rotation + (rotation - this.lastPinchRotation);
      this.props.onRotationChange && this.props.onRotationChange(newRotation);
      this.lastPinchRotation = rotation;
    });
  }

  render() {
    const {
      image,
      video,
      mediaProps,
      transform,
      crop: { x, y },
      rotation,
      zoom,
      cropShape,
      showGrid,
      style: { containerStyle, cropAreaStyle, mediaStyle },
      classes: { containerClassName, cropAreaClassName, mediaClassName }
    } = this.props;
    return /*#__PURE__*/ (0, _jsxRuntime.jsxs)("div", {
      onMouseDown: this.onMouseDown,
      onTouchStart: this.onTouchStart,
      ref: (el) => (this.containerRef = el),
      "data-testid": "container",
      style: containerStyle,
      className: (0, _helpers.classNames)(
        "reactEasyCrop_Container",
        containerClassName
      ),
      children: [
        image
          ? /*#__PURE__*/ (0, _jsxRuntime.jsx)("img", {
              alt: "",
              className: (0, _helpers.classNames)(
                "reactEasyCrop_Image",
                mediaClassName
              ),
              ...mediaProps,
              src: image,
              ref: (el) => (this.imageRef = el),
              style: {
                ...mediaStyle,
                transform:
                  transform ||
                  `translate(${x}px, ${y}px) rotate(${rotation}deg) scale(${zoom})`
              },
              onLoad: this.onMediaLoad
            })
          : video &&
            /*#__PURE__*/ (0, _jsxRuntime.jsx)("video", {
              autoPlay: true,
              loop: true,
              muted: true,
              className: (0, _helpers.classNames)(
                "reactEasyCrop_Video",
                mediaClassName
              ),
              ...mediaProps,
              src: video,
              ref: (el) => (this.videoRef = el),
              onLoadedMetadata: this.onMediaLoad,
              style: {
                ...mediaStyle,
                transform:
                  transform ||
                  `translate(${x}px, ${y}px) rotate(${rotation}deg) scale(${zoom})`
              },
              controls: false
            }),
        this.state.cropSize &&
          /*#__PURE__*/ (0, _jsxRuntime.jsx)("div", {
            style: {
              ...cropAreaStyle,
              width: this.state.cropSize.width,
              height: this.state.cropSize.height
            },
            "data-testid": "cropper",
            className: (0, _helpers.classNames)(
              "reactEasyCrop_CropArea",
              cropShape === "round" && "reactEasyCrop_CropAreaRound",
              showGrid && "reactEasyCrop_CropAreaGrid",
              cropAreaClassName
            )
          })
      ]
    });
  }
}

_defineProperty(Cropper, "defaultProps", {
  zoom: 1,
  rotation: 0,
  aspect: 4 / 3,
  maxZoom: MAX_ZOOM,
  minZoom: MIN_ZOOM,
  cropShape: "rect",
  showGrid: true,
  style: {},
  classes: {},
  mediaProps: {},
  zoomSpeed: 1,
  restrictPosition: true,
  zoomWithScroll: true
});

_defineProperty(Cropper, "getMousePoint", (e) => ({
  x: Number(e.clientX),
  y: Number(e.clientY)
}));

_defineProperty(Cropper, "getTouchPoint", (touch) => ({
  x: Number(touch.clientX),
  y: Number(touch.clientY)
}));

var _default = Cropper;
exports.default = _default;
