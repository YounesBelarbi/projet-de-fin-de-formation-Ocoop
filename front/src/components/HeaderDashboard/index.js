import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCogs, faSignOutAlt, faUserEdit, faUserCheck, faUserTimes } from '@fortawesome/free-solid-svg-icons'
import { useSelector, useDispatch } from 'react-redux';



import { Button, Card, Media, Form } from 'react-bootstrap';
import { Link } from 'react-router-dom';

import './style.sass';

const HeaderDashboard = () => {

    const activeState = useSelector(state => ({
        ...state.headerDashboardReducer,
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
        dispatch({
            type: `SUBMIT_EDIT_PROFILE`
        })
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
                            <h4>{activeState.username}</h4>
                            <h5>{activeState.frequency}</h5>
                            <p>{activeState.description}</p>
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
                           src="http://image.noelshack.com/fichiers/2019/04/5/1548409064-ppullpup.png"
                           alt="Generic placeholder"
                        />
                        <Media.Body>
                            <Form className="edit-profile-form">
                                <Form.Group controlId="username">
                                    <Form.Control size="lg" type="text" className="edit-profile-username" value={activeState.copyChange.username} onChange={handleChangeInput}/>
                                </Form.Group>
                                <Form.Group controlId="frequency">
                                    <Form.Control type="text" className="edit-profile-frequency" value={activeState.copyChange.frequency} onChange={handleChangeInput}/>
                                </Form.Group>
                                <Form.Group controlId="description">
                                    <Form.Control as="textarea" className="edit-profile-description" rows="5" value={activeState.copyChange.description} onChange={handleChangeInput}/>
                                </Form.Group>
                            </Form>
                        </Media.Body>
                    </Media>
                    <Card.Body>
                        <ul>
                            <li onClick={() => {submitEditProfile()}}>Enregister <FontAwesomeIcon icon={faUserCheck}/></li>
                            <li onClick={() => {showEditProfile()}}>Annuler <FontAwesomeIcon icon={faUserTimes}/></li>
                        </ul>
                        
                        
                        
                    </Card.Body>
                </Card>
                )}
                

                <ul>
                    <a href="#"><li>paramètre <FontAwesomeIcon icon={faCogs}/></li></a>
                    <a href="#"><li>se déconnecter <FontAwesomeIcon icon={faSignOutAlt}/></li></a>
                </ul>

            </div>
        </div>
        <h1 className="header-logo">LOGO</h1>
    </nav>
</header>
};

export default HeaderDashboard;