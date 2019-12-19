/**
 * Imports de dépendances
 */
import React, { useState, useEffect } from 'react';
import axios from 'axios';
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

  async function showGame() {
    axios.post("http://127.0.0.1:8000/games/list", "",
    {
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(function (response) {
    console.log('HTTP RESPONSE STATUT:', response.status);
    console.log(response);

    if(response.status === 200) {        
        console.log("poster",response.data);
        setGamesList({gamesList: response.data})
        console.log("gamesList",gamesList.gamesList);
    }
    else {
        console.log('error submit');
    }
    
    })
    .catch(function (error) {
    console.log(error);
    });
  }

  useEffect(() => {
    showGame();
  }, []);

  const [gamesList, setGamesList] = useState({gamesList: [{}]});

   return <Container fluid className="mb-5">
  <Row className="justify-content-center">


  {
    gamesList.gamesList.map((game, i) => {
      return (
        <Col key={i} lg={3} md={4} sm={12} className="pt-5">
        <Card className="bg-dark text-white hover-card rounded-card">
        <Card.Img className="rounded-card" src={`http://localhost:8000/../assets/images/games-home/${game.poster}`} alt={game.title} />
        <Card.ImgOverlay>
        <Card.Title className="hidden-title">Trouver des joueurs de {game.title}</Card.Title>
        </Card.ImgOverlay>
    </Card>
    </Col>
      )
    })
  }




  </Row>
  </Container> ;
}

/**
 * Export
 */
export default HomeCards;

/**{['CS:GO', 'WOW', 'OverWatch', 'Adibou', 'CandyCrush'].map(i => (
  <Col key={i} lg={3} md={4} sm={12} className="pt-5">
  <Card className="bg-dark text-white hover-card rounded-card">
      <Card.Img className="rounded-card" src="https://lesplayersdudimanche.com/wp-content/uploads/2017/02/Dust-2.jpg" alt="Card image" />
      <Card.ImgOverlay>
          <Card.Title className="hidden-title">Trouver des joueurs de {i}</Card.Title>
      </Card.ImgOverlay>
  </Card>
  </Col>
  ))}
  

    
  */