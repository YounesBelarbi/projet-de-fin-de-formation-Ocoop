import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faUserFriends, faUsers, faNewspaper, faBlog, faClipboardList } from '@fortawesome/free-solid-svg-icons'

//import "rbx/index.css";

import './style.sass';

const Header = () => {
    return <header>
        <nav role="navigation">
            <div id="menuToggle">
                <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu" className="header-menu-ul">
                    <a href="#"><li>Teams <FontAwesomeIcon icon={faUserFriends}/></li></a>
                    <a href="#"><li>Guildes <FontAwesomeIcon icon={faUsers}/></li></a>
                    <a href="#"><li>News <FontAwesomeIcon icon={faNewspaper}/></li></a>
                    <a href="#"><li>Blog <FontAwesomeIcon icon={faBlog}/></li></a>
                    <a href="#" target="_blank"><li>Mention légales <FontAwesomeIcon icon={faClipboardList}/></li></a>
                </ul>
            </div>
            
            <img src="http://localhost:8000/../assets/images/logo4.png" className="header-logo"/>
        </nav>
    </header>
}

export default Header;