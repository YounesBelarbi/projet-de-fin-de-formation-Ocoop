import React from 'react';

import Card from 'src/components/Card';
//import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
//import { faCoffee, faBars } from '@fortawesome/free-solid-svg-icons'
import {Button, Column} from 'rbx';
import "rbx/index.css";
import './style.sass';

const HomeMain = () => {
    return <div className="home-main">
                <div className="home-content">
                    <p className="home-description">O'coop est une plateforme de mise en relation de joueurs. Choisisez un jeu, cherchez des mates et jouez !</p>
                    
                    <Column.Group multiline centered>
                        <Column desktop={{size: 'two-fifths'}} mobile={{size: 'full'}} >
                            <Button className="btn-main btn-right-align">S'inscrire</Button>
                        </Column>
                        <Column desktop={{size: 'two-fifths'}} mobile={{size: 'full'}}>
                            <Button className="btn-main btn-signin btn-left-align">Se connecter</Button>
                        </Column>
                    </Column.Group>
                </div>
                <Card />
            </div>
}

export default HomeMain;

//