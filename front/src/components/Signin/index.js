import React from 'react';
import { Form, Button, Col, Row } from 'react-bootstrap';


// Données
// Styles et assets
// import sass
import './style.sass';

const Signin = () => {
    return <Form className="signup-form ">
        <Row className="justify-content-center">
            <Col lg={5} md={8} sm={10} xs={11}>
                <Form.Group controlId="formBasicEmail">
                <Form.Label>Adresse email</Form.Label>
                <Form.Control type="email" placeholder="Entrez email" className="form-input"/>
                <Form.Text className="text-muted">
                    Nous ne partagerons jamais vos informations
                </Form.Text>
                </Form.Group>
                <Form.Group controlId="formBasicPassword">
                    <Form.Label>Mot de passe</Form.Label>
                    <Form.Control type="password" placeholder="Entrez mot de passe" className="form-input"/>
                </Form.Group>
                <Form.Group controlId="formBasicCheckbox">
                    <Form.Check type="checkbox" label="Se souvenir de moi" />
                </Form.Group>
            </Col>
        </Row>     
        <Row className="justify-content-center">
            <Col lg={3} md={6} sm={8} xs={10}>  
                <Button variant="primary" type="submit" className="btn-main btn-submit">
                    Se connecter
                </Button>
            </Col>
        </Row>

    </Form>
};

export default Signin