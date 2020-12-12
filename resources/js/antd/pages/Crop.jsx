import React from 'react';
import { LoadingOutlined, PlusOutlined } from '@ant-design/icons';
import { Modal, message } from 'antd';
import ReactCrop from 'react-image-crop';
import 'react-image-crop/dist/ReactCrop.css';

function beforeUpload(file) {

    const isJpgOrPng = file.type === 'image/jpeg' || file.type === 'image/png';
    if (!isJpgOrPng) {
        message.error('You can only upload JPG/PNG file!');
    }
    const isLt2M = file.size / 1024 / 1024 < 2;
    if (!isLt2M) {
        message.error('Image must smaller than 2MB!');
    }
    return isJpgOrPng && isLt2M;
}



function getBase64(blob, callback) {
    if (typeof blob === "string") {
        fetch(blob).then(res => res.blob()).then(blob => getBase64(blob, callback))
        return;
    }
    var reader = new FileReader();
    reader.readAsDataURL(blob);
    reader.onloadend = function () {
        callback(reader.result);
    }
}



export default class extends React.Component {
    constructor(props) {
        super(...arguments);
        this.state = {
            modalVisible: false,
            src: false,
            croppedImageUrl: false,
            crop: {
                unit: '%',
                width: 100,
                height: 100,
            },
        };

        this.onSelectFile = this.onSelectFile.bind(this);
        this.onImageLoaded = this.onImageLoaded.bind(this);
        this.onCropComplete = this.onCropComplete.bind(this);
        this.onCropChange = this.onCropChange.bind(this);
        this.makeClientCrop = this.makeClientCrop.bind(this);
        this.getCroppedImg = this.getCroppedImg.bind(this);
        this.handleUpdateImage = this.handleUpdateImage.bind(this);
        this.uploadMe = React.createRef();
        this.imageRef = React.createRef();
    }
    componentDidMount(props){
        getBase64(this.props.defaultSrc,src=>this.setState({src}))        
    }
    onImageLoaded(image) {
        this.imageRef = image;
    };

    onCropComplete(crop) {
        this.makeClientCrop(crop);
    };

    onCropChange(crop, percentCrop) {
        this.setState({ crop });
    };

    async makeClientCrop(crop) {
        if (this.imageRef && crop.width && crop.height) {
            const croppedImageUrl = await this.getCroppedImg(
                this.imageRef,
                crop,
                'newFile.jpeg'
            );
            // getBase64(croppedImageUrl,src=>this.setState({src,croppedImageUrl}));
            this.setState({ croppedImageUrl })

        }
    }

    getCroppedImg(image, crop, fileName) {
        const canvas = document.createElement('canvas');
        const scaleX = image.naturalWidth / image.width;
        const scaleY = image.naturalHeight / image.height;
        canvas.width = crop.width;
        canvas.height = crop.height;
        const ctx = canvas.getContext('2d');

        ctx.drawImage(
            image,
            crop.x * scaleX,
            crop.y * scaleY,
            crop.width * scaleX,
            crop.height * scaleY,
            0,
            0,
            crop.width,
            crop.height
        );

        return new Promise((resolve, reject) => {
            canvas.toBlob(blob => {
                if (!blob) {
                    //reject(new Error('Canvas is empty'));
                    console.error('Canvas is empty');
                    return;
                }
                blob.name = fileName;
                window.URL.revokeObjectURL(this.fileUrl);
                this.fileUrl = window.URL.createObjectURL(blob);
                resolve(this.fileUrl);
            }, 'image/jpeg');
        });
    }

    onSelectFile(e) {
        this.setState({
            crop: {
                unit: '%',
                width: 100,
                height: 100,
            }
        });
        if (e.target.files && e.target.files.length > 0) {
            if (beforeUpload(e.target.files[0])) {
                getBase64(e.target.files[0], (src) => this.setState({ modalVisible: true, src }));
            }
        }
    };


    handleUpdateImage(file) {
        getBase64(this.state.croppedImageUrl, src => this.setState({ src, modalVisible: false }, () => this.props.onChange(src)));
    }
    render() {
        const { src, crop } = this.state;
        return <>
            <div className="ant-upload ant-upload-select ant-upload-select-picture-card" onClick={e => this.uploadMe.click()}>
                <input type="file" ref={ref => { this.uploadMe = ref }} accept="image/*" onChange={this.onSelectFile} style={{ display: "none" }} />
                {src ? <img src={src} alt="avatar" style={{ width: '100%' }} className="ant-upload" /> : <span tabIndex="-111" className="ant-upload" role="button">

                    <div>
                        <span role="img" aria-label="plus" className="anticon anticon-plus">
                            <svg viewBox="64 64 896 896" focusable="false" data-icon="plus" width="1em" height="1em" fill="currentColor" aria-hidden="true">
                                <path d="M482 152h60q8 0 8 8v704q0 8-8 8h-60q-8 0-8-8V160q0-8 8-8z"></path><path d="M176 474h672q8 0 8 8v60q0 8-8 8H176q-8 0-8-8v-60q0-8 8-8z"></path>
                            </svg>
                        </span>
                        <div style={{ marginTop: '8px' }}>Upload</div>
                    </div>
                </span>}
            </div>

            <Modal
                title="Profile Picture"
                visible={this.state.modalVisible}
                onOk={this.handleUpdateImage}
                onCancel={() => setTimeout(() => this.setState({ modalVisible: false, src: false, croppedImageUrl: false }), 250)}
                okText="Upload"
                cancelText="Cancel"
            >
                {src && (
                    <ReactCrop
                        src={src}
                        crop={crop}
                        ruleOfThirds
                        onImageLoaded={this.onImageLoaded}
                        onComplete={this.onCropComplete}
                        onChange={this.onCropChange}
                    />
                )}
            </Modal>
        </>
    }
}