import React from "react";
import { Container, Row, Col, DropdownButton, Dropdown } from "react-bootstrap";

import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faTimes } from "@fortawesome/free-solid-svg-icons";

export default function Head(props) {
  return (
    <Container>
      <Row className="head ">
        <Col className="m-0 p-0">
          <p class="h4  links2"> {props.state} <div class="borderBottom"> </div> </p>
        </Col>

        <Col className=" m-0 p-0 d-flex  justify-content-end">
          <DropdownButton
            className="dropdownbtn"
            id="dropdown-basic-button"
            title="filter"
          >
            <div className="dropItems">
              <div>
                {" "}
                <button className="cross btn ">
                  {" "}
                  <FontAwesomeIcon icon={faTimes} />{" "}
                </button>{" "}
              </div>

              <Dropdown.Item href="#/action-1">
                {" "}
                <p className="items"> New to Oldest </p>{" "}
              </Dropdown.Item>
              <Dropdown.Item href="#/action-1">
                <p className="items"> Oldest to Newest </p>{" "}
              </Dropdown.Item>
              <Dropdown.Item href="#/action-1">
                {" "}
                <p className="items"> Most Popular </p>{" "}
              </Dropdown.Item>
              <Dropdown.Item href="#/action-1">
                {" "}
                <p className="items"> Alphabetical </p>{" "}
              </Dropdown.Item>
            </div>
          </DropdownButton>
        </Col>
      </Row>
    </Container>
  );
}
