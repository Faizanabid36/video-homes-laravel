import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";

import {Container, Row, Col} from "react-bootstrap";

export default class AllVideos extends React.Component {
    render() {
        return (
            <Container fluid>
                <Row>
                    <Col className="sidebar p-0">
                        {/*<Sidebar/>*/}
                    </Col>

                    <Col
                        lg={10}
                        xs={{span: 12}}
                        sm={{span: 12, offset: 0}}
                        md={{span: 12, offset: 1}}
                    >
                        <Container className="container">
                            <Row>
                                <Col>
                                    <div className="headbar">
                                        <Navbar bg="light" expand="lg">
                                            <Navbar.Toggle aria-controls="basic-navbar-nav"/>
                                            <Navbar.Collapse id="basic-navbar-nav">
                                                <Nav className="mr-auto ">
                                                    <Nav.Link href="#home">
                                                        <h4 className="links2"> Videos </h4>
                                                    </Nav.Link>
                                                    <Nav.Link href="#link">
                                                        <h4 className="links2"> Playlist </h4>
                                                    </Nav.Link>
                                                    <Nav.Link href="#link">
                                                        <h4 className="links2"> Customization </h4>
                                                    </Nav.Link>
                                                    <Nav.Link href="#link">
                                                        <h4 className="links2"> Analytics </h4>
                                                    </Nav.Link>
                                                    <Nav.Link href="#link">
                                                        <h4 className="links2"> Downgrade/Upgrade </h4>
                                                    </Nav.Link>
                                                </Nav>

                                                <div
                                                    className=" d-flex w-25   justify-content-around align-items-center">
                                                    <div>
                                                        {" "}
                                                        <FontAwesomeIcon icon={faBell} className="bell"/>{" "}
                                                    </div>
                                                    <div>
                                                        {" "}
                                                        <FontAwesomeIcon
                                                            icon={faSearch}
                                                            color="rgba(154, 157, 159, 0.7) "
                                                        />{" "}
                                                    </div>
                                                    <div>
                                                        {" "}
                                                        <img
                                                            width="30px"
                                                            src={
                                                                "https://cdn.clipart.email/fb5edb6111170103831f483d01b34ae7_business-person-clipart_228-298.png"
                                                            }
                                                            alt=""
                                                        />{" "}
                                                    </div>
                                                </div>
                                            </Navbar.Collapse>
                                        </Navbar>
                                    </div>

                                </Col>
                            </Row>
                            <Row>
                                <Col className="d-flex justify-content-center ">
                                    {" "}
                                    {/*<Head state={"ACTIVE"}/>{" "}*/}
                                </Col>{" "}
                            </Row>
                        </Container>

                        <Container>
                            <Row className=" Cards-container  ">
                                <Col sm={12} md={6} lg={4}>
                                    <InBody/>
                                </Col>
                                <Col sm={12} md={6} lg={4}>
                                    <InBody/>
                                </Col>
                                <Col sm={12} md={6} lg={4}>
                                    <InBody/>
                                </Col>
                            </Row>

                            <Row>
                                <Col className="d-flex justify-content-center  ">
                                    {" "}
                                    {/*<Head state={"INACTIVE"}/>{" "}*/}
                                </Col>{" "}
                            </Row>

                            <Row className=" Cards-container  ">
                                <Col className="cards-body" sm={12} md={6} lg={4}>
                                    <InBody/>
                                </Col>
                                <Col className="cards-body" sm={12} md={6} lg={4}>
                                    <InBody/>
                                </Col>
                                <Col className="cards-body" sm={12} md={6} lg={4}>
                                    <InBody/>
                                </Col>
                            </Row>
                        </Container>
                    </Col>
                </Row>
            </Container>
        );
    }
}
