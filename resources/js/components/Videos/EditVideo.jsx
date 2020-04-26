import { Button, Carousel, Col,Row, Container, Form } from "react-bootstrap";
import React, { useCallback, useState,useEffect } from "react";


export default function EditVideo(props){
    const [state, setState] = useState(false);
    const [thumbnails, setThumbnails] = useState(false);
    const [index, setIndex] = useState(0);
    const handleSelect = useCallback((selectedIndex, e) => {
        setIndex(selectedIndex);
        console.log(thumbnails[selectedIndex + 1]);
        state.thumbnail = thumbnails[selectedIndex + 1];
        setState(state);
    }, [state, thumbnails]);
    const onUpdate = useCallback(e => {
        axios.put('update-video/' + state.id, {...state}).then(({data}) => {
            window.location.href = window.VIDEO_APP.base_url+"/"+state.username + "/watch_video?v=" + state.video_id;
        })
    }, [state, thumbnails]);

    useEffect(() => {
        axios.get(`edit_video/${props.match.params.id}`).then(({data})=>{
            setState({...data.video});
            setThumbnails(data.thumbnails);
        })
    }, []);

    return <Container className="container main-content" id="main-container">
        <div id="container_content">
            <Row><Col xs={8} className="mx-auto">
                <Carousel interval={null} activeIndex={index} onSelect={handleSelect}>
                    {console.log('t', thumbnails)}
                    {thumbnails && Object.values(thumbnails).map(v => {
                            console.log(v);
                            return <Carousel.Item>
                                <img
                                    className="d-block w-100"
                                    src={window.VIDEO_APP.base_url + "/storage/" + v}
                                />

                            </Carousel.Item>
                        }
                    )}
                </Carousel>
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
                <Button variant="primary" onClick={onUpdate}>
                    Update and Preview Video
                </Button>
            </Col></Row>
        </div>
    </Container>
}
