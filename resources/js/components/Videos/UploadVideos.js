import React, { useCallback, useState } from 'react';
import { useDropzone } from 'react-dropzone'
import {Carousel} from 'react-bootstrap';

function MyDropzone() {
    const [uploadProgress, updateUploadProgress] = useState(0);
    const [uploading, setUploading] = useState(false);
    const [state, setState] = useState(false);
    const [thumbnails, setThumbnails] = useState(false);
    const [index, setIndex] = useState(0);

    const handleSelect = (selectedIndex, e) => {
        setIndex(selectedIndex);
    };
    const onDrop = useCallback(files => {
        // Do something with the files
        const formData = new FormData();
        formData.append('video', files[0]);
        setUploading(true);
        axios({
            method: 'post',
            url: '/upload-video',
            data: formData,
            headers: {'Content-Type': 'multipart/form-data'},
            onUploadProgress: (ev) => {
                const progress = ev.loaded / ev.total * 100;
                updateUploadProgress(Math.round(progress));
            },
        })
            .then(({data}) => {
                setUploading(false);
                console.log(data.video);
                setState({...data.video});
                setThumbnails(data.newThumbnail);
                // window.location.href = window.location.toString().replace("upload-video",'watch')+"?v="+data.video.video_id;

            })
            .catch((err) => {
                setUploading(false);
            });
    }, []);
    const onUpdate = useCallback(e => {
        axios.put('update-video/' + state.id, {...state}).then(({data}) => {
            window.location.href = window.VIDEO_APP.base_url + "watch_video?v=" + state.video_id;
        })
    }, [state,thumbnails]);

    const {getRootProps, getInputProps, isDragActive} = useDropzone({onDrop})
    return <div className="container main-content" id="main-container">
        <div id="container_content">
            <div className="wo_about_wrapper_parent">
                <div className="wo_about_wrapper">
                    <div className="hero hero-overlay" style={{backgroundColor: "#b228c9"}}>
                        <div className="container">
                            <h1 className="text-center">Upload new video</h1>
                        </div>
                    </div>
                    <svg className="wave" width="100%" height="50px" preserveAspectRatio="none"
                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 75">
                        <defs>
                            <clipPath id="a">
                                <rect style={{fill: "none"}} className="a" width="1920" height="75"></rect>
                            </clipPath>
                        </defs>
                        <title>wave</title>
                        <g className="b" style={{clipPath: 'url(#a)'}}>
                            <path className="c" style={{fill: '#b228c9'}}
                                  d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48"/>
                        </g>
                        <g className="b" style={{clipPath: 'url(#a)'}}>
                            <path className="d" style={{fill: '#b228c9', opacity: '0.5', isolation: 'isolate'}}
                                  d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10"/>
                        </g>
                        <g className="b" style={{clipPath: 'url(#a)'}}>
                            <path className="d" style={{fill: '#b228c9', opacity: '0.5', isolation: 'isolate'}}
                                  d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24"/>
                        </g>
                        <g className="b" style={{clipPath: 'url(#a)'}}>
                            <path className="d" style={{fill: '#b228c9', opacity: '0.5', isolation: 'isolate'}}
                                  d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150"/>
                        </g>
                    </svg>
                </div>
            </div>
            <div className="row">
                {!state && <div {...getRootProps()} className="col-8 mx-auto pt_page_margin">
                    <div className="content pt_shadow">
                        <div className="col-md-12 pt_upload_vdo">
                            <div className="upload upload-video" data-block="video-drop-zone">
                                <div>
                                    <svg fill="currentColor" height="24" viewBox="0 0 24 24" width="24"
                                         xmlns="http://www.w3.org/2000/svg" className="feather feather-upload">
                                        <path
                                            d="M14,13V17H10V13H7L12,8L17,13M19.35,10.03C18.67,6.59 15.64,4 12,4C9.11,4 6.6,5.64 5.35,8.03C2.34,8.36 0,10.9 0,14A6,6 0 0,0 6,20H19A5,5 0 0,0 24,15C24,12.36 21.95,10.22 19.35,10.03Z"/>
                                    </svg>
                                    <h4>Drag & Drop File</h4>
                                    <p>
                                        {
                                            isDragActive ?
                                                <p>Drop the files here ...</p> :
                                                <p>Drag 'n' drop some files here, or click here to select</p>
                                        }
                                    </p>

                                </div>
                            </div>
                            <div className="progress hidden">
                                <span className="percent">0%</span>
                                <div className="progress_bar_parent">
                                    <div className="bar upload-progress-bar progress-bar active"/>
                                </div>
                                <div className="clear"/>
                                <div className="text-center pt_prcs_vdo"/>
                            </div>
                            <input
                                {...getInputProps()}
                                // ref={(ref) => this.upload = ref}
                                // style={{display: 'none'}}
                                // onChange={this.uploadFile}
                                type="file" name="video" accept="video/*"
                                // className="upload-video-file"
                            />
                        </div>
                        <div className="clear"/>
                    </div>
                </div>}
                {uploading && <div className="col-8 mx-auto">
                    <div className="progress h-25">
                        <div className="progress-bar progress-bar-success progress-bar-striped progress-bar-animated"
                             role="progressbar" aria-valuenow={uploadProgress} aria-valuemin="0" aria-valuemax="100"
                             style={{width: uploadProgress + "%"}}>{`${uploadProgress}% uploaded`}</div>
                    </div>
                </div>}
            </div>
            {state && <div className="row">
                <div className="col-8 mx-auto">
                    <Carousel activeIndex={index} onSelect={handleSelect}>
                        {thumbnails && Object.values(thumbnails).map(v=>{
                            <Carousel.Item>
                                <img
                                    className="d-block w-100"
                                    src={window.VIDEO_APP.base_url+"storage/"+v}
                                />

                            </Carousel.Item>
                        })}
                    </Carousel>
                    <div className="form-group">
                        <label htmlFor="title">Title</label>
                        <input
                            type="text"
                            id="title"
                            defaultValue={state.title}
                            onChange={e => {
                                state.title = e.target.value;
                                setState(state);
                            }}
                            className="form-control" placeholder="Title"/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="description">Description</label>
                        <input
                            type="text"
                            id="description"
                            onChange={e => {
                                state.description = e.target.value;
                                setState(state)
                            }}
                            className="form-control" placeholder="Description"/>
                    </div>
                    <div className="form-group">
                        <button onClick={onUpdate} className="btn btn-main">Update and Preview Video</button>
                    </div>
                </div>
            </div>}
        </div>
    </div>;
}

export default MyDropzone;
