/**
 * Imports de dépendances
 */
import React from 'react';

/**
 * Imports locaux
 */

// Composants React
// import VoteWidget from 'src/components/VoteWidget';
// import TestingHooks from 'src/components/TestingHooks';
import { Container, Row, Col, Card } from 'react-bootstrap';

// Données
// Styles et assets
import './app.sass';

/**
 * Code
 */ //className="home-cards"
const HomeCards = () => {
   return <Container fluid className="mb-5">
  <Row className="justify-content-center">
  {['CS:GO', 'WOW', 'OverWatch', 'Adibou', 'CandyCrush'].map(i => (
    <Col lg={3} md={4} sm={12} className="pt-5">
    <Card className="bg-dark text-white hover-card rounded-card">
        <Card.Img className="rounded-card" src="https://lesplayersdudimanche.com/wp-content/uploads/2017/02/Dust-2.jpg" alt="Card image" />
        <Card.ImgOverlay>
            <Card.Title className="hidden-title">Trouver des joueurs de {i}</Card.Title>
        </Card.ImgOverlay>
    </Card>
    </Col>
    ))}
  </Row>
  </Container> ;
}

/**
 * Export
 */
export default HomeCards;