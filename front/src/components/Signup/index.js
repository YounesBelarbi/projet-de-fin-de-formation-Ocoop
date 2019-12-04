import React, { useState } from 'react';

import Header from 'src/components/Header';
import Footer from 'src/components/Footer';

import { Form, Button, Col, Row } from 'react-bootstrap';
// import sass
import './style.sass';

const Signup = () => {


    const [userInfo, setUserInfo] = useState({
        pseudo: '',
        mail: '',
        birth: '',
        password: '',
        passwordVerif: '',

    })

    const handleChange = (event) => {

        const property = event.target.id;
        console.log(property);
        setUserInfo({
            property : event.target.value
        })

        

    
    };




    return <div className="signup">
            <div className="signup-container">
                <div className="signup-form">
                    <Form>
                        <Row className="justify-content-center">
                            <Col lg={5} md={6} sm={8} xs={10}>
                            <Form.Group controlId="pseudo">
                                <Form.Label>Pseudo*</Form.Label>
                                <Form.Control type="text" id="pseudo" placeholder="Pseudo" className="form-input" onChange={handleChange}/>
                            </Form.Group>

                            <Form.Group controlId="formBasicEmail">
                                <Form.Label>mail*</Form.Label>
                                <Form.Control type="email" id="mail"  placeholder="Mail" className="form-input" onChange={handleChange}/>
                                <Form.Text className="text-muted">
                                    Nous ne partagerons jamais vos informations
                                </Form.Text>
                            </Form.Group>

                            <Form.Group controlId="date">
                                <Form.Label>Date de naissance*</Form.Label>
                                <Form.Control type="date" id="birth"  className="form-input" onChange={handleChange}/>
                            </Form.Group>
                            

                            <Form.Group controlId="formBasicPassword">
                                <Form.Label>Mot de passe*</Form.Label>
                                <Form.Control type="password" id="password"  placeholder="Mot de passe" className="form-input" onChange={handleChange}/>
                            </Form.Group>

                            <Form.Group controlId="passwordVerif">
                                <Form.Label>Mot de passe*</Form.Label>
                                <Form.Control type="password" id="passwordVerif"  placeholder="Mot de passe" className="form-input" onChange={handleChange}/>
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