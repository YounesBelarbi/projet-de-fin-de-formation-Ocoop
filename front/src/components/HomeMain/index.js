import React from 'react';
import { Link } from 'react-router-dom';
import Card from 'src/components/Card';
//import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
//import { faCoffee, faBars } from '@fortawesome/free-solid-svg-icons'
import {Container, Row, Col, Button} from 'react-bootstrap';
import './style.sass';

const HomeMain = () => {
    return <div className="home-main">
                <div className="home-content">
                    <p className="home-description">O'coop est une plateforme de mise en relation de joueurs. Choisisez un jeu, cherchez des mates et jouez !</p>
                    
                    <Container>
                        <Row>
                            <Col lg={6} md={6} sm={12}>
                                <Link to="/signup"><Button className="btn-main btn-right-align">S'inscrire</Button></Link>
                            </Col>
                            <Col lg={6} md={6} sm={12}>
                                <Link to="/signin"><Button className="btn-main btn-signin btn-left-align">Se connecter</Button></Link>
                            </Col>
                        </Row>
                    </Container>
                </div>
                <Card />
            </div>
}

export default HomeMain;

//