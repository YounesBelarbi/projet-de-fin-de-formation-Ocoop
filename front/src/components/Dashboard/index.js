import React, { useState, useEffect } from 'react';
import { useSelector, useDispatch } from 'react-redux';
import { Button, Container, Row, Col, Media, Card, Collapse, Form } from 'react-bootstrap';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faGolfBall, faPlusCircle, faChevronDown } from '@fortawesome/free-solid-svg-icons';
import axios from 'axios';
import useForm from "react-hook-form";
import { useHistory } from 'react-router-dom';

import './style.sass';

const Dashboard = () => {

    const dispatch = useDispatch();

    const activeState = useSelector(state => ({
        ...state.dashboardReducer
    }));

    const headerDashboardReducer = useSelector(state => ({
        ...state.headerDashboardReducer
    }));

    useEffect(() => {
        getGameDataFromAPI();
      }, []);

    let history = useHistory();

    async function getGameDataFromAPI() {
    axios.post("http://localhost:8000/games/list",
    "", {
    headers: {
        'Content-Type': 'application/json'
    }
    }).then(function (response) {
        console.log('HTTP RESPONSE STATUT:', response.status);
        console.log(response);
        if(response.status === 200) {
            dispatch({
            type: `GET_GAME_LIST`,
            data:[
                ...response.data
            ]
            })
        }
        else {
            console.log('error serveur');
        }
    }).catch(function (error) {
        console.log(error);
        history.push("/");
    });
      };

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
        dispatch({
            type: `SET_INFOS_TO_FIND_MATE`
        });
    };

    // controles du form
    const addGame = () => {
        dispatch({
            type: 'SHOW_ADD_GAME_PANEL'
        })
    };

    const handleChange = (event) => {
        const property = event.target.id;
        dispatch({
            type: `ADD_FAVORITE_${property.toUpperCase()}`,
            data: event.target.value
          });
    };

    const { register, handleSubmit, errors } = useForm();

    const submitAddGame = (event) => {
        event.preventDefault();
        let token = activeState.token;
        if(!token || token === "") {
            console.log('pas de token trouvé')
            return history.push("/signin");
        }
        else{
            console.log("gameToAdd", JSON.stringify({...activeState.addGamePanel.gameToAdd}));
            axios.post("http://127.0.0.1:8000/api/user/add/games/favorite",
            JSON.stringify({...activeState.addGamePanel.gameToAdd}), {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+token
                }
            })
            .then(function (response) {
                console.log('HTTP RESPONSE STATUT:', response.status);
                console.log('On vien dajouter' ,response);

                if(response.status === 200) {        
                    dispatch({
                        type: `ADD_FAVORITE_GAME`,
                        data: response.data
                        });
                    dispatch({
                        type: `SELECT_GAME`,
                        data: activeState.favoriteGameList.length
                        });
                    dispatch({
                        type: `SET_INFOS_TO_FIND_MATE`
                    });
                }
                else {
                    console.log('error submit');
                }   
            })
            .catch(function (error) {
            console.log(error);
            });
        }
    };

    const handleSelectGame = () => {

        axios.post("http://127.0.0.1:8000/games/ranksbygame",
        JSON.stringify({game_id: activeState.addGamePanel.gameToAdd.gameId}), {
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(function (response) {
        console.log('HTTP RESPONSE STATUT:', response.status);
        console.log(response);

        if(response.status === 200) {        
            dispatch({
                type: `GET_RANKS_BY_GAME`,
                data: response.data.ranks_game
                });
        }
        else {
            console.log('error submit');
        }
        
        })
        .catch(function (error) {
        console.log(error);
        });
    }

    const findMate = () => {
        let token = activeState.token;
        if(!token || token === "") {
            console.log('pas de token trouvé')
            return history.push("/signin");
        }
        else{
            console.log(JSON.stringify({...activeState.findMates, frequency_name: headerDashboardReducer.user.frequency}));
            axios.post("http://127.0.0.1:8000/api/user/matchmaking",
            JSON.stringify({...activeState.findMates, frequency_name: headerDashboardReducer.user.frequency}), {
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer '+token
                }
            })
            .then(function (response) {
                console.log('HTTP RESPONSE STATUT:', response.status);
                console.log(response);
                if(response.status === 200) {        
                    dispatch({
                        type: `SHOW_MATE`,
                        data: response.data
                        });
                        //todo gerer le reducer
                }
                else {
                    console.log('error submit');
                }
            })
            .catch(function (error) {
            console.log(error);
            });
        }
    }

    return(
        <div className="dashboard">
            
            <Container fluid className="p-3">
            
                    <Row>
                        <Col lg={2} md={2} sm={2} xs={2} className="dashboard-game-list">
                            <Container fluid>
                            {
                                activeState.favoriteGameList.map((game, key) => {
                                    console.log(game);
                                    return <Row key={key} className="justify-content-end">
                                            <div className={`game-row ${ game.isSelected ? "game-isSelected" : "" }`}>
                                                <Media onClick={() => {selectGame(key)}} >
                                                    <img
                                                    width={100}
                                                    height={100}
                                                    className="dashboard-images"
                                                    src={`\back\public\assets\images\games-posters${game.logo}`}
                                                    alt={game.title}
                                                />
                                                </Media>
                                            </div>
                                        </Row>       
                                    })
                            }
                                <Row className="justify-content-end">
                                    <div className="game-row dashboard-images add-game-dashboard" onClick={() => {addGame()}}>
                                        
                                        <p className="add-span">+</p>
                                        
                                    </div> 
                                </Row> 
                            </Container>
                        </Col>

                        <Col lg={9} md={9} sm={10} xs={10} className="dashboard-main">
                       
                            {!activeState.addGamePanel.isOpen ? (
                            <Container fluid>
                                <Row className="justify-content-center">
                                    <Button className="dashboard-main-btn" onClick={() => {findMate()}} >Rechercher un mate</Button>
                                </Row>
                                <Row>
                                    <Col>
                                        <h3 className="dashboard-main-header">Joueur(s) disponible(s)</h3>
                                    </Col>
                                </Row>
                                <Row>
                                {
                                    activeState.matchingResultPlayers.map((user, key) => {
                                        console.log(user);
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
                                                                <Button className="dashboard-main-btn">Ajoute moi</Button>
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
                             ): ( 
                                <Container fluid>
                                    <Row className="justify-content-center form-add-game">
                                        <Form onSubmit={submitAddGame}>
                                            {/* <Form.Row>
                                                <Form.Group controlId="selected_platform">
                                                    <Form.Label>Selectionner votre plateforme de jeu</Form.Label>
                                                    <Form.Control as="select" defaultValue={""} onChange={handleChange} >
                                                        <option value="PC" disabled hidden>PC</option>
                                                        {
                                                            activeState.addGamePanel.plateformList.map((plateform) => {
                                                            return <option key={plateform.id} value={plateform.id}>{plateform.name}</option>
                                                            })
                                                        }
                                                    </Form.Control>
                                                </Form.Group>     
                                            </Form.Row> */}
                                            <Form.Row>
                                                <Form.Group controlId="selected_game">
                                                    <Form.Label>Selectionner votre jeu</Form.Label>
                                                    <Form.Control as="select" defaultValue={""} onChange={handleChange} on>
                                                        <option value="" disabled hidden>Selectionner votre jeu...</option>
                                                        {
                                                            activeState.addGamePanel.gameList.map((game, key) => {
                                                            return <option key={key} value={game.id} onClick={handleSelectGame} >{game.title}</option>
                                                            })
                                                        }
                                                    </Form.Control>
                                                </Form.Group>
                                            </Form.Row>
                                            {activeState.addGamePanel.gameToAdd.gameId !== "" &&
                                                <Form.Row>
                                                    <Form.Group controlId="selected_rank">
                                                        <Form.Label>Selectionner votre rank</Form.Label>
                                                        <Form.Control as="select" defaultValue={""} onChange={handleChange}>
                                                            <option value="" disabled hidden>Selectionner votre rank...</option>
                                                            {
                                                                activeState.addGamePanel.rankList.map((rank) => {
                                                                return <option key={rank.id} value={rank.id}>{rank.name}</option>
                                                                })
                                                            }
                                                        </Form.Control>
                                                    </Form.Group>     
                                                </Form.Row>
                                            }
                                            {/* {activeState.addGamePanel.gameToAdd.rankId !== "" &&
                                                <Form.Row>
                                                    <Form.Group controlId="selected_frequency">
                                                        <Form.Label>Selectionner votre style de jeu</Form.Label>
                                                        <Form.Control as="select" defaultValue={""} onChange={handleChange}>
                                                            <option value="" disabled hidden>Selectionner votre style...</option>
                                                            {
                                                                activeState.addGamePanel.frequencyList.map((frequency) => {
                                                                return <option key={frequency.id} value={frequency.id}>{frequency.name}</option>
                                                                })
                                                            }
                                                        </Form.Control>
                                                    </Form.Group>     
                                                </Form.Row>
                                            } */}
                                            {activeState.addGamePanel.gameToAdd.rankId !== "" &&
                                                <Button variant="primary" type="submit">
                                                Ajouter ce jeu dans ma liste
                                                </Button>
                                            }
                                        </Form>

                                    </Row>

                                        {/* <Col xl={8} lg={6} md={6} sm={12} xm={12} className="col-card">
                                        <form onSubmit={handleSubmit(submitAddGame)}>
                                            <Row className="justify-content-center">
                                            <Col lg={12} md={6} sm={8} xs={10}>

                                            <Form.Group controlId="frequency">
                                                <select name="Frequency" ref={register} className="btn-select">
                                                    <option value="chill">chill</option>
                                                    <option value=" compétitif"> compétitif</option>
                                                </select>
                                            </Form.Group>

                                            <Form.Group controlId="rank">
                                                <select name="rank" ref={register} className="btn-select">
                                                    <option value="bronze">bronze</option>
                                                    <option value=" silver"> silver</option>
                                                    <option value=" gold"> gold</option>
                                                    <option value=" diamant"> diamant</option>
                                                </select>
                                            </Form.Group>

                                            <Form.Group controlId="rank">
                                                <select name="plateforme" ref={register} className="btn-select">
                                                    <option value="pc">pc</option>
                                                    <option value=" ps4"> ps4</option>
                                                    <option value=" xbox"> xbox</option>
                                                    <option value=" switch"> switch</option>
                                                </select>
                                            </Form.Group>

                                            <input type="submit" className="btn-main btn-submit"/>
                                            </Col>
                                            </Row>
                                        </form>
                                    </Col>
                                </Row> */}
                            </Container>
                             )}
                            
                        </Col>
                    </Row>
            </Container>
        </div>
    );
}

export default Dashboard;