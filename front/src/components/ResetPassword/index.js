import React from 'react';
import { Link } from 'react-router-dom'
import { Form, Button, Col, Row } from 'react-bootstrap';

const ResetPassword = () => {
    return <Form className="signup-form">
        <Row className="justify-content-center">
            <Col lg={5} md={8} sm={10} xs={11}>
                <Form.Group controlId="email">
                <Form.Label>Adresse email</Form.Label>
                <Form.Control name="email" type="email" placeholder="Entrez email" className="form-input"/>
                <Form.Text className="text-muted">
                
                    Nous ne partagerons jamais vos informations
                </Form.Text>
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

export default ResetPassword;