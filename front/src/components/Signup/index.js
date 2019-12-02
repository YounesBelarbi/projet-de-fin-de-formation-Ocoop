import React from 'react';

import Header from 'src/components/Header';
import Footer from 'src/components/Footer';

import { Form, Button, Col, Row } from 'react-bootstrap';
// import sass
import './style.sass';

const Signup = () => {
    return <div className="signup">
            <div className="signup-container">
                <div className="signup-form">
                    <Form>
                    <Row className="justify-content-center">
                        <Col lg={5} md={6} sm={8} xs={10}>
                        <Form.Group controlId="pseudo">
                            <Form.Label>Pseudo</Form.Label>
                            <Form.Control type="text" placeholder="Pseudo" className="form-input"/>
                        </Form.Group>

                        <Form.Group controlId="formBasicEmail">
                            <Form.Label>mail</Form.Label>
                            <Form.Control type="email" placeholder="Mail" className="form-input"/>
                        </Form.Group>

                        <Form.Group controlId="formBasicPassword">
                            <Form.Label>Mot de passe</Form.Label>
                            <Form.Control type="password" placeholder="Mot de passe" className="form-input"/>
                        </Form.Group>

                        <Form.Group controlId="passwordVerif">
                            <Form.Label>Mot de passe</Form.Label>
                            <Form.Control type="password" placeholder="Mot de passe" className="form-input"/>
                        </Form.Group>

                        <Form.Group controlId="formBasicCheckbox">
                            <Form.Check type="checkbox" label="J'accepte les conditions générales d'utilisation" />
                        </Form.Group>
                        </Col>
                        </Row>
                        <Row className="justify-content-center">
                            <Col lg={3} md={6} sm={8} xs={10}>  
                                <Button variant="primary" type="submit" className="btn-main btn-submit">
                                    s'inscrire
                                </Button>
                            </Col>
                        </Row>   
                    </Form> 
                </div>
            </div>
        </div>
}

export default Signup