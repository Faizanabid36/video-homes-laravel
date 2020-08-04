import { Button, Carousel, Col, Row, Container, Form } from "react-bootstrap";
import React, { useCallback, useState, useEffect } from "react";
import TagsInput from 'react-tagsinput'
import 'react-tagsinput/react-tagsinput.css'

export default function EditVideo(props) {
    const [state, setState] = useState(false);
    const [tags, setTags] = useState([]);
    const [categories, setCategories] = useState(false);
    const [manualupload, setManualupload] = useState(false);
    const [thumbnails, setThumbnails] = useState(false);
    const [index, setIndex] = useState(0);
    const handleSelect = useCallback((selectedIndex, e) => {
        setIndex(selectedIndex);
        state.thumbnail = thumbnails[selectedIndex + 1];
        setState(state);
    }, [state, thumbnails]);
    const onUpdate = useCallback(e => {
        axios.put('update-video/' + state.id, {...state}).then(({data}) => {
            window.location.href = window.VIDEO_APP.base_url + "/u/" + state.username + "/" + state.video_id;
        })
    }, [state, thumbnails]);
    const deleteVideo = useCallback(e => {
        let retVal = confirm("Do you really want to Delete?");
        if (retVal) {
            axios.post('delete_video', {...state})
                .then((res) => {
                    if (res.data.success != 0) {
                        window.location.href = window.VIDEO_APP.base_url + '/dashboard/#/videos';
                    }
                })
                .catch((err) => {
                    console.log(err)
                })
            return true;
        } else {
            return false;
        }
    }, [state]);

    useEffect(() => {

        axios.get(`edit_video/${props.match.params.id}`).then(({data}) => {
            data.video.tags = data.video.tags ?? [];
            setState({...data.video});
            setTags(data.video.tags);
            let index = data.video.thumbnail.match(/-(\d+).png/);
            if (index && index[1]) {
                setIndex(index[1] - 1);
            }
            setThumbnails(data.thumbnails);
            setCategories(data.categories)
        })
    }, []);

    return <Container className="container main-content" id="main-container">
        <div id="container_content">
            <Row><Col>
                <Form.Group controlId="manual_upload">
                    {!manualupload ? <Carousel interval={null} activeIndex={index} onSelect={handleSelect}>
                            {thumbnails && Object.values(thumbnails).map(v => {

                                    return <Carousel.Item>
                                        <img
                                            className="d-block w-100"
                                            src={window.VIDEO_APP.base_url + "/storage/" + v}
                                        />

                                    </Carousel.Item>
                                }
                            )}
                        </Carousel> :
                        <Form.File id="upload-thumbnail" custom>
                            <Form.File.Input onChange={e => console.log(e)}/>
                            <Form.File.Label data-browse="Upload Thumbnail Image">
                                Upload Thumbnail Image
                            </Form.File.Label>
                        </Form.File>}
                </Form.Group>

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
                    {tags && <TagsInput value={tags} onChange={e => {
                        setTags(e);
                        state.tags = e;
                        setState(state);
                    }}/>}
                </Form.Group>
                {categories && <Form.Group controlId="category">
                    <Form.Label>Category</Form.Label>
                    <Form.Control as="select" size={'md'} custom defaultValue={state.category_id} onChange={e => {
                        state.category_id = e.target.value;
                        setState(state);
                    }}>
                        {categories.map((v, k) => <option key={k} value={v.id}>{v.name}</option>)}
                    </Form.Control>
                </Form.Group>}
                <Button variant="primary" onClick={onUpdate}>
                    Update and Preview Video
                </Button>
                <Button variant="danger" onClick={deleteVideo}>
                    Delete Video
                </Button>
            </Col></Row>
        </div>
    </Container>
}
