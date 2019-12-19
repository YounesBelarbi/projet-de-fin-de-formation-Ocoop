import React, { useState, useEffect } from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCogs, faSignOutAlt, faUserEdit, faUserCheck, faUserTimes } from '@fortawesome/free-solid-svg-icons'
import { useSelector, useDispatch } from 'react-redux';
import { useHistory } from 'react-router-dom';
import axios from 'axios';


import { Button, Card, Media, Form } from 'react-bootstrap';
import { Link } from 'react-router-dom';

import './style.sass';

const HeaderDashboard = () => {

    useEffect(() => {
        getDataFromAPI();
      }, []);

    let history = useHistory();

    async function getDataFromAPI() {
        let token = document.cookie
        console.log(token);
        if(!token || token === "") {
            console.log('pas de token trouvé')
            return history.push("/signin");
        }
        else {
            axios.post("http://localhost:8000/api/user/tokencheck",
            "", {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+token
            }
          }).then(function (response) {
            console.log('HTTP RESPONSE STATUT:', response.status);
            console.log(response);
            if(response.status === 200) {
              dispatch({
                type: `SET_USER_INFOS`,
                data: {
                    ...response.data,
                    token: token
                }
              })
              history.push("/dashboard");
              dispatch({
                type: `SET_INFOS_TO_FIND_MATE`
              });
            }
            else {
                console.log('error serveur');
            }
          }).catch(function (error) {
      
            console.log(error);
            history.push("/");
          });
        }
    
      };

    const activeState = useSelector(state => ({
        ...state.headerDashboardReducer,
    }));

    const dashboardState = useSelector(state => ({
        ...state.dashboardReducer,
    }));

    const dispatch = useDispatch();

    const showEditProfile = () => {
        dispatch({
            type: `SHOW_EDIT_PROFILE`
        })
    }

    const handleChangeInput = (event) => {
        const property = event.target.id;
        dispatch({
          type: `EDIT_PROFILE_${property.toUpperCase()}`,
          data: event.target.value
        });

    };

    const submitEditProfile = () => {
        let token = dashboardState.token;
        console.log(JSON.stringify({...activeState.copyChange}));
        if(!token || token === "") {
            console.log('pas de token trouvé')
            return history.push("/signin");
        }
        else if(activeState.copyChange.username.length >= 3){
            axios.post("http://localhost:8000/api/profile/edit",
            JSON.stringify({...activeState.copyChange}), {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+token
            }
          }).then(function (response) {
            console.log('HTTP RESPONSE STATUT:', response.status);
            console.log(response);
            if(response.status === 200) {
                dispatch({
                    type: `SUBMIT_EDIT_PROFILE`
                })
            }
            else {
                console.log('error serveur');
            }
          }).catch(function (error) {
            console.log(error);
          });
        }
    }

    const logout = () => {
        document.cookie = "";
        history.push("/signin");
        dispatch({
            type: `LOGOUT`
        });
    }

    return <header>
    <nav role="navigation">
        <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <div id="dashboard-menu">

                {/* if showeditor is false */}
                {!activeState.showEditor ? (
                <Card>
                    <Media>
                        <img
                            width={94}
                            height={94}
                            className="mr-3"
                            src="https://pbs.twimg.com/profile_images/2565206995/image.jpg"
                            alt="Generic placeholder"
                        />
                        <Media.Body>
                            <h4>{activeState.user.username}</h4>
                            <h5>{activeState.user.frequency}</h5>
                            <p>{activeState.user.description}</p>
                        </Media.Body>
                    </Media>
                    <Card.Body>
                        <FontAwesomeIcon icon={faUserEdit} onClick={() => {showEditProfile()}}/>
                    </Card.Body>
                </Card>
                ) : (
                <Card>
                    <Media>
                        <img
                           width={94}
                           height={94}
                           className="mr-3"
                           src={"https://pbs.twimg.com/profile_images/2565206995/image.jpg"}
                           alt="Generic placeholder"
                        />
                        <Media.Body>
                            <Form className="edit-profile-form">
                                <Form.Group controlId="username">
                                    <Form.Control size="lg" type="text" className="edit-profile-username" value={activeState.copyChange.username} onChange={handleChangeInput}/>
                                </Form.Group>
                                <Form.Group controlId="frequency">
                                    <Form.Control as="select" className="edit-profile-frequency" defaultValue={activeState.copyChange.frequency} onChange={handleChangeInput}>
                                        {activeState.copyChange.frequency === "" &&
                                            <option value="" disabled hidden>Dite quel type de joueur vous êtes</option>
                                        }
                                        {
                                            activeState.frequencyList.map((frequency) => {
                                            return <option key={frequency.id} value={frequency.name}>{frequency.name}</option>
                                            })
                                        }
                                    </Form.Control>
                                </Form.Group>    
                                {/* <Form.Group controlId="frequency">
                                    <Form.Control type="text" className="edit-profile-frequency" value={activeState.copyChange.frequency} onChange={handleChangeInput}/>
                                </Form.Group> */}
                                <Form.Group controlId="description">
                                    <Form.Control as="textarea" className="edit-profile-description" rows="5" placeholder="Description" value={activeState.copyChange.description} onChange={handleChangeInput}/>
                                </Form.Group>
                            </Form>
                        </Media.Body>
                    </Media>
                    <Card.Body>
                        <ul>
                            <li onClick={() => {showEditProfile()}}>Annuler <FontAwesomeIcon icon={faUserTimes}/></li>
                            <li onClick={() => {submitEditProfile()}} >Enregister <FontAwesomeIcon icon={faUserCheck}/></li>
                        </ul>
                        
                        
                        
                    </Card.Body>
                </Card>
                )}
                

                <ul className="header-menu-ul">
                    <a href="#"><li>paramètre <FontAwesomeIcon icon={faCogs}/></li></a>
                    <a href="#" onClick={() => {logout()}} ><li>se déconnecter <FontAwesomeIcon icon={faSignOutAlt}/></li></a>
                </ul>

            </div>
        </div>
        <img src="http://localhost:8000/../assets/images/logo4.png" className="header-logo"/>
    </nav>
</header>
};

export default HeaderDashboard;