"use strict";

Object.defineProperty(exports, "__esModule", {
    value: true
});
exports.getCropSize = getCropSize;
exports.restrictPosition = restrictPosition;
exports.getDistanceBetweenPoints = getDistanceBetweenPoints;
exports.getRotationBetweenPoints = getRotationBetweenPoints;
exports.computeCroppedArea = computeCroppedArea;
exports.getInitialCropFromCroppedAreaPixels = getInitialCropFromCroppedAreaPixels;
exports.getCenter = getCenter;
exports.rotateAroundMidPoint = rotateAroundMidPoint;
exports.translateSize = translateSize;
exports.classNames = classNames;

/**
 * Compute the dimension of the crop area based on media size,
 * aspect ratio and optionally rotation
 */
function getCropSize(mediaWidth, mediaHeight, containerWidth, containerHeight, aspect, rotation = 0) {
    const {
        width,
        height
    } = translateSize(mediaWidth, mediaHeight, rotation);
    const fittingWidth = Math.min(width, containerWidth);
    const fittingHeight = Math.min(height, containerHeight);

    if (fittingWidth > fittingHeight * aspect) {
        return {
            width: fittingHeight * aspect,
            height: fittingHeight
        };
    }

    return {
        width: fittingWidth,
        height: fittingWidth / aspect
    };
}
/**
 * Ensure a new media position stays in the crop area.
 */


function restrictPosition(position, mediaSize, cropSize, zoom, rotation = 0) {
    const {
        width,
        height
    } = translateSize(mediaSize.width, mediaSize.height, rotation);
    return {
        x: restrictPositionCoord(position.x, width, cropSize.width, zoom),
        y: restrictPositionCoord(position.y, height, cropSize.height, zoom)
    };
}

function restrictPositionCoord(position, mediaSize, cropSize, zoom) {
    const maxPosition = mediaSize * zoom / 2 - cropSize / 2;
    return Math.min(maxPosition, Math.max(position, -maxPosition));
}

function getDistanceBetweenPoints(pointA, pointB) {
    return Math.sqrt(Math.pow(pointA.y - pointB.y, 2) + Math.pow(pointA.x - pointB.x, 2));
}

function getRotationBetweenPoints(pointA, pointB) {
    return Math.atan2(pointB.y - pointA.y, pointB.x - pointA.x) * 180 / Math.PI;
}
/**
 * Compute the output cropped area of the media in percentages and pixels.
 * x/y are the top-left coordinates on the src media
 */


function computeCroppedArea(crop, mediaSize, cropSize, aspect, zoom, rotation = 0, restrictPosition = true) {
    // if the media is rotated by the user, we cannot limit the position anymore
    // as it might need to be negative.
    const limitAreaFn = restrictPosition && rotation === 0 ? limitArea : noOp;
    const croppedAreaPercentages = {
        x: limitAreaFn(100, ((mediaSize.width - cropSize.width / zoom) / 2 - crop.x / zoom) / mediaSize.width * 100),
        y: limitAreaFn(100, ((mediaSize.height - cropSize.height / zoom) / 2 - crop.y / zoom) / mediaSize.height * 100),
        width: limitAreaFn(100, cropSize.width / mediaSize.width * 100 / zoom),
        height: limitAreaFn(100, cropSize.height / mediaSize.height * 100 / zoom)
    }; // we compute the pixels size naively

    const widthInPixels = Math.round(limitAreaFn(mediaSize.naturalWidth, croppedAreaPercentages.width * mediaSize.naturalWidth / 100));
    const heightInPixels = Math.round(limitAreaFn(mediaSize.naturalHeight, croppedAreaPercentages.height * mediaSize.naturalHeight / 100));
    const isImgWiderThanHigh = mediaSize.naturalWidth >= mediaSize.naturalHeight * aspect; // then we ensure the width and height exactly match the aspect (to avoid rounding approximations)
    // if the media is wider than high, when zoom is 0, the crop height will be equals to iamge height
    // thus we want to compute the width from the height and aspect for accuracy.
    // Otherwise, we compute the height from width and aspect.

    const sizePixels = isImgWiderThanHigh ? {
        width: Math.round(heightInPixels * aspect),
        height: heightInPixels
    } : {
        width: widthInPixels,
        height: Math.round(widthInPixels / aspect)
    };
    const croppedAreaPixels = { ...sizePixels,
        x: Math.round(limitAreaFn(mediaSize.naturalWidth - sizePixels.width, croppedAreaPercentages.x * mediaSize.naturalWidth / 100)),
        y: Math.round(limitAreaFn(mediaSize.naturalHeight - sizePixels.height, croppedAreaPercentages.y * mediaSize.naturalHeight / 100))
    };
    return {
        croppedAreaPercentages,
        croppedAreaPixels
    };
}
/**
 * Ensure the returned value is between 0 and max
 */


function limitArea(max, value) {
    return Math.min(max, Math.max(0, value));
}

function noOp(_max, value) {
    return value;
}
/**
 * Compute the crop and zoom from the croppedAreaPixels
 */


function getZoomFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize) {
    const mediaZoom = mediaSize.width / mediaSize.naturalWidth;

    if (cropSize) {
        const isHeightMaxSize = cropSize.height > cropSize.width;
        return isHeightMaxSize ? cropSize.height / mediaZoom / croppedAreaPixels.height : cropSize.width / mediaZoom / croppedAreaPixels.width;
    }

    const aspect = croppedAreaPixels.width / croppedAreaPixels.height;
    const isHeightMaxSize = mediaSize.naturalWidth >= mediaSize.naturalHeight * aspect;
    return isHeightMaxSize ? mediaSize.naturalHeight / croppedAreaPixels.height : mediaSize.naturalWidth / croppedAreaPixels.width;
}
/**
 * Compute the crop and zoom from the croppedAreaPixels
 */


function getInitialCropFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize) {
    const mediaZoom = mediaSize.width / mediaSize.naturalWidth;
    const zoom = getZoomFromCroppedAreaPixels(croppedAreaPixels, mediaSize, cropSize);
    const cropZoom = mediaZoom * zoom;
    const crop = {
        x: ((mediaSize.naturalWidth - croppedAreaPixels.width) / 2 - croppedAreaPixels.x) * cropZoom,
        y: ((mediaSize.naturalHeight - croppedAreaPixels.height) / 2 - croppedAreaPixels.y) * cropZoom
    };
    return {
        crop,
        zoom
    };
}
/**
 * Return the point that is the center of point a and b
 */


function getCenter(a, b) {
    return {
        x: (b.x + a.x) / 2,
        y: (b.y + a.y) / 2
    };
}
/**
 *
 * Returns an x,y point once rotated around xMid,yMid
 */


function rotateAroundMidPoint(x, y, xMid, yMid, degrees) {
    const cos = Math.cos;
    const sin = Math.sin;
    const radian = degrees * Math.PI / 180; // Convert to radians
    // Subtract midpoints, so that midpoint is translated to origin
    // and add it in the end again

    const xr = (x - xMid) * cos(radian) - (y - yMid) * sin(radian) + xMid;
    const yr = (x - xMid) * sin(radian) + (y - yMid) * cos(radian) + yMid;
    return [xr, yr];
}
/**
 * Returns the new bounding area of a rotated rectangle.
 */


function translateSize(width, height, rotation) {
    const centerX = width / 2;
    const centerY = height / 2;
    const outerBounds = [rotateAroundMidPoint(0, 0, centerX, centerY, rotation), rotateAroundMidPoint(width, 0, centerX, centerY, rotation), rotateAroundMidPoint(width, height, centerX, centerY, rotation), rotateAroundMidPoint(0, height, centerX, centerY, rotation)];
    const minX = Math.min(...outerBounds.map(p => p[0]));
    const maxX = Math.max(...outerBounds.map(p => p[0]));
    const minY = Math.min(...outerBounds.map(p => p[1]));
    const maxY = Math.max(...outerBounds.map(p => p[1]));
    return {
        width: maxX - minX,
        height: maxY - minY
    };
}
/**
 * Combine multiple class names into a single string.
 */


function classNames(...args) {
    return args.filter(value => {
        if (typeof value === 'string' && value.length > 0) {
            return true;
        }

        return false;
    }).join(' ').trim();
}
