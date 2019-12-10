import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Button, Container, Row, Col, Media, Card, Collapse } from 'react-bootstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faGolfBall, faPlusCircle, faChevronDown } from '@fortawesome/free-solid-svg-icons';

import { Link } from 'react-router-dom';

import './style.sass';

const Dashboard = () => {

    const JEUX = [{
        id: 1,
        name: "CS:Go",
        image: "https://steamcdn-a.akamaihd.net/steam/subs/54029/header_586x192.jpg?t=1544227353"
    },
    {
        id: 2,
        name: "Adibou",
        image: "https://images-na.ssl-images-amazon.com/images/I/51lek1O4e4L.jpg"
    },
    {
        id: 3,
        name: "SpongeBob",
        image: "https://upload.wikimedia.org/wikipedia/en/3/33/SpongeBob_SuperSponge_PS1.jpg"
    },
    {
        id: 4,
        name: "Overwatch",
        image: "https://blznav.akamaized.net/img/games/cards/card-overwatch-7eff92e1257149aa.jpg"
    }];

    // const setOpen = (isOpen, id)  => {

    // };

    const activeState = useSelector(state => ({
        ...state.dashboardReducer,
    }));

    console.log(activeState);

    const dispatch = useDispatch();

    const showPlayerCard = (key) => {
        dispatch({
            type: `SHOW_PLAYER_CARD`,
            data: key
          });
    };


    // const [open, setOpen] = useState(false);


    return( <div className="dashboard">
            <Container fluid className="p-3">
                    <Row>
                        <Col lg={2} md={2} sm={2} xs={2} className="dashboard-game-list">
                            <Container fluid>
                            {
                                JEUX.map(jeu => {
                                    return  <Row className="justify-content-center">
                                                <div className="game-row">
                                                    <Media>
                                                        <img
                                                        width={100}
                                                        height={100}
                                                        className="dashboard-images"
                                                        src={jeu.image}
                                                        alt={jeu.name}
                                                        key={jeu.id}
                                                    />
                                                    </Media>
                                                </div>
                                            </Row> 
                                        })
                            }
                                <Row className="justify-content-center">
                                    <div className="dashboard-images add-game-dashboard">
                                        <span className="add-span">+</span>    
                                    </div> 
                                </Row>
                            </Container>
                        </Col>

                        <Col lg={9} md={9} sm={10} xs={10} className="dashboard-main">
                            <Container fluid>
                                <Row className="justify-content-center">
                                    <Button className="dashboard-main-btn">Rechercher un mate</Button>
                                </Row>
                                <Row>
                                    <Col>
                                        <h3 className="dashboard-main-header">Joueur(s) disponible(s)</h3>
                                    </Col>
                                </Row>
                                <Row>
                                {
                                    activeState.matchingResultPlayers.map((user, key) => {
                                        return <Col xl={4} lg={6} md={6} sm={12} xm={12} className="p-1" key={user.userId}>
                                            <Card className="dahsboard-main-user">
                                                <Media>
                                                    <img
                                                        width={46}
                                                        height={46}
                                                        src={user.image}
                                                        alt={user.username}
                                                        className="dahsboard-main-user-img"
                                                    />
                                                    <Media.Body className="dahsboard-main-user-body" onClick={() => {showPlayerCard(key)}}>
                                                        <div className="dashboard-main-visible-header">
                                                            <h5 className="dahsboard-main-user-username">{user.username}</h5>
                                                            <FontAwesomeIcon size="2x" icon={faChevronDown} />
                                                        </div>
                                                        <Collapse in={user.isOpen}>
                                                            <p className="dahsboard-main-user-description">
                                                                {user.description}
                                                            </p>
                                                        </Collapse>  
                                                    </Media.Body>          
                                                </Media>
                                            </Card>
                                        </Col>
                                    })
                                }
                                </Row>   
                            </Container>
                            
                        </Col>
                    </Row>
            </Container>
        </div>
    );
}

export default Dashboard;