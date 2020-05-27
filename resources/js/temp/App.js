import React from "react";
import Sidebar from "./Sidebar";
import Header from "./Header";
import InBody from "./Inbody";
import Head from "./Head";
import "bootstrap/dist/css/bootstrap.min.css";

import { Container, Row, Col } from "react-bootstrap";

import "./styles.scss";

export default function App() {
    return (
        <Container fluid>
            <Row>
                <Col className="sidebar p-0">
                    <Sidebar />
                </Col>

                <Col
                    lg={10}
                    xs={{ span: 12 }}
                    sm={{ span: 12, offset: 0 }}
                    md={{ span: 12, offset: 1 }}
                >
                    <Container className="container">
                        <Row>
                            <Col>
                                <Header />
                            </Col>
                        </Row>
                        <Row>
                            <Col className="d-flex justify-content-center ">
                                {" "}
                                <Head state={"ACTIVE"} />{" "}
                            </Col>{" "}
                        </Row>
                    </Container>

                    <Container>
                        <Row className=" Cards-container  ">
                            <Col sm={12} md={6} lg={4}>
                                <InBody />
                            </Col>
                            <Col sm={12} md={6} lg={4}>
                                <InBody />
                            </Col>
                            <Col sm={12} md={6} lg={4}>
                                <InBody />
                            </Col>
                        </Row>

                        <Row>
                            <Col className="d-flex justify-content-center  ">
                                {" "}
                                <Head state={"INACTIVE"} />{" "}
                            </Col>{" "}
                        </Row>

                        <Row className=" Cards-container  ">
                            <Col className="cards-body" sm={12} md={6} lg={4}>
                                <InBody />
                            </Col>
                            <Col className="cards-body" sm={12} md={6} lg={4}>
                                <InBody />
                            </Col>
                            <Col className="cards-body" sm={12} md={6} lg={4}>
                                <InBody />
                            </Col>
                        </Row>
                    </Container>
                </Col>
            </Row>
        </Container>
    );
}
