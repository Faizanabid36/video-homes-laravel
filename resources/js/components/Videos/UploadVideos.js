import React, {useCallback, useState, useEffect} from 'react';
import TagsInput from 'react-tagsinput'
import 'react-tagsinput/react-tagsinput.css'
import {useDropzone} from 'react-dropzone'
import {Carousel, Form, Row, Col, Container, ProgressBar, Button} from 'react-bootstrap';


function MyDropzone(props) {
    const [uploadProgress, updateUploadProgress] = useState(0);
    const [uploading, setUploading] = useState(false);
    const [state, setState] = useState(false);
    const [thumbnails, setThumbnails] = useState(false);
    const [index, setIndex] = useState(0);
    const [categories, setCategories] = useState('');
    const [tags, setTags] = useState([]);

    const handleSelect = useCallback((selectedIndex, e) => {
        setIndex(selectedIndex);
        console.log(thumbnails[selectedIndex + 1]);
        state.thumbnail = thumbnails[selectedIndex + 1];
        setState(state);
    }, [state, thumbnails]);
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
                axios.get(window.VIDEO_APP.base_url + '/categories').then((res) => {
                    console.log(res.data);
                    setCategories(res.data.categories)
                });
                setUploading(false);
                props.history.push(`edit_video/${data.video.video_id}`)
            })
            .catch((err) => {
                setUploading(false);
            });
    }, [props]);
    const onUpdate = useCallback(e => {
        state.tags = tags.toString()
        setState(state);
        axios.put('update-video/' + state.id, {...state}).then(({data}) => {
            window.location.href = window.VIDEO_APP.base_url + "/" + state.username + "/watch_video?v=" + state.video_id;
        })
    }, [state, thumbnails]);

    const {getRootProps, getInputProps, isDragActive} = useDropzone({onDrop});
    // useEffect(() => {
    //     console.log(thumbnails,Object.values(thumbnails),"effects");
    //     // return () => {
    //     //     effect
    //     // };
    // }, [thumbnails]);

    return <Container>
        <div className="drag-drop-container ">
            <Row>
                {!state && <Col xs={8} {...getRootProps()} className="mx-auto">
                    <Col className="pt_upload_vdo drag-drop-box">
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
                        <input
                            {...getInputProps()}
                            // ref={(ref) => this.upload = ref}
                            // style={{display: 'none'}}
                            // onChange={this.uploadFile}
                            type="file" name="video" accept="video/*"
                            // className="upload-video-file"
                        />
                    </Col>
                    <div className="clear"/>
                </Col>}
            </Row>
            {uploading && <Row><Col xs={8} className={'mx-auto'}><ProgressBar animated id="progress"
                                                                              now={uploadProgress}/>{`${uploadProgress}% uploaded`}
            </Col></Row>}
            {state && <Row>
                <Col xs={8} className="mx-auto">
                    <Carousel interval={null} activeIndex={index} onSelect={handleSelect}>
                        {thumbnails && Object.values(thumbnails).map(v => {
                                return <Carousel.Item>
                                    <img
                                        className="d-block w-100"
                                        src={window.VIDEO_APP.base_url + "/storage/" + v}
                                    />

                                </Carousel.Item>
                            }
                        )}
                    </Carousel>
                    <div className="form">
                        <Form.Group controlId="title">
                            <Form.Label>Title</Form.Label>
                            <Form.Control placeholder="Title" defaultValue={state.title} onChange={e => {
                                state.title = e.target.value;
                                setState(state);
                            }}/>
                        </Form.Group>
                        <Form.Group controlId="description">
                            <Form.Label>Description</Form.Label>
                            <Form.Control placeholder="Description" defaultValue={state.description} onChange={e => {
                                state.description = e.target.value;
                                setState(state);
                            }}/>
                        </Form.Group>
                        <Form.Group controlId="tags">
                            <Form.Label>Tags</Form.Label>
                            <TagsInput placeholder="Tags" value={tags} onChange={e => {
                                setTags(e);
                            }}/>
                        </Form.Group>
                        <Form.Group controlId="exampleForm.ControlSelect1">
                            <Form.Label>Video Category</Form.Label>
                            <Form.Control as="select" onChange={(e) => {
                                state.video_type = e.target.value;
                                setState(state);
                            }}>
                                {categories && categories.map((i, index) => {
                                    return <option value={i.id} key={index}>{i.name}</option>
                                })}
                            </Form.Control>
                        </Form.Group>
                    </div>
                    <Button id="form-btn" onClick={onUpdate}>
                        Update and Preview Video
                    </Button>
                </Col>
            </Row>}
        </div>
    </Container>;
}

export default MyDropzone;
