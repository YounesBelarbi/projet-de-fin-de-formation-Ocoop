import React from 'react';
//import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
//import { faCoffee, faBars } from '@fortawesome/free-solid-svg-icons'
import {Button, Column} from 'rbx';
import "rbx/index.css";
import './style.sass';

const HomeMain = () => {
    return <div className="home-main">
        <p className="home-description">Voyez ce jeu exquis wallon, de graphie en kit mais bref. Portez ce vieux whisky au juge blond qui fume sur son île intérieure, à côté de l'alcôve ovoïde, où les bûches se consument dans l'âtre, ce qui lui permet de penser à la cænogenèse de l'être dont il est question dans la cause ambiguë entendue à Moÿ, dans un capharnaüm qui, pense-t-il, diminue çà et là la </p>
        
        <Column.Group>
            <Column textAlign="centered" size="auto"><Button className="btn-main">S'inscrire</Button></Column>
            <Column textAlign="centered" size="auto"> <Button className="btn-main btn-signin">Se connecter</Button></Column>
        </Column.Group>
        
    </div>
}

export default HomeMain;