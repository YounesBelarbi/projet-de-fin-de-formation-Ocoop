import React, { useState } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Button, Container, Row, Col, Media, Card, Collapse } from 'react-bootstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faGolfBall, faPlusCircle, faChevronDown } from '@fortawesome/free-solid-svg-icons';

import { Link } from 'react-router-dom';

import './style.sass';

const Dashboard = () => {

    const activeState = useSelector(state => ({
        ...state.dashboardReducer,
    }));

    const dispatch = useDispatch();

    const showPlayerCard = (key) => {
        dispatch({
            type: `SHOW_PLAYER_CARD`,
            data: key
          });
    };

    const selectGame = (key) => {
        dispatch({
            type: `SELECT_GAME`,
            data: key
          });
          
    };

    return( <div className="dashboard">
            <Container fluid className="p-3">
                    <Row>
                        <Col lg={2} md={2} sm={2} xs={2} className="dashboard-game-list">
                            <Container fluid>
                            {
                                activeState.gameList.map((game, key) => {
                                    console.log(game);
                                    return  <Row key={game.gameId} className="justify-content-end">
                                                <div className={`game-row ${ game.isSelected ? "game-isSelected" : "" }`}>
                                                    <Media onClick={() => {selectGame(key)}} >
                                                        <img
                                                        width={100}
                                                        height={100}
                                                        className="dashboard-images"
                                                        src={game.image}
                                                        alt={game.name}
                                                    />
                                                    </Media>
                                                </div>
                                            </Row> 
                                        })
                            }
                                {/* <Row className="justify-content-end">
                                    <div className={`game-row dashboard-images add-game-dashboard ${ game.isSelected ? "game-isSelected" : "" }`}>
                                        <span className="add-span">+</span>
                                    </div> 
                                </Row> */}
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
                                        return <Col xl={4} lg={6} md={6} sm={12} xm={12} className="col-card" key={user.userId}>
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