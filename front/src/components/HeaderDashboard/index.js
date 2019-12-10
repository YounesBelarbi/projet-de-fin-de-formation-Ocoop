import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCogs, faSignOutAlt, faUserCog } from '@fortawesome/free-solid-svg-icons'

import { Button, Card, Media } from 'react-bootstrap';
import { Link } from 'react-router-dom';

import './style.sass';

const HeaderDashboard = () => {
    return <header>
    <nav role="navigation">
        <div id="menuToggle">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
            <div id="dashboard-menu">

                <Card style={{ }}>
                <Media>
                    <img
                        width={94}
                        height={94}
                        className="mr-3"
                        src="http://image.noelshack.com/fichiers/2019/04/5/1548409064-ppullpup.png"
                        alt="Generic placeholder"
                    />
                    <Media.Body>
                        <h4>Pascal</h4>
                        <h5>Compétitif</h5>
                        <p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                        </p>
                    </Media.Body>
                </Media>
                <Card.Body>
                    <FontAwesomeIcon icon={faUserCog}/>
                </Card.Body>
                </Card>
                

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