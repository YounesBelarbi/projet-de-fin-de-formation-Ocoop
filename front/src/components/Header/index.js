import React from 'react';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCoffee, faBars } from '@fortawesome/free-solid-svg-icons'
import {Navbar} from 'rbx';

import "rbx/index.css";

import './style.sass';

const Header = () => {
    return <header>

        {/* <Column  desktop={ narrow= boolean, size=12 }>
          
        </Column> */}
        <nav role="navigation">
            <div id="menuToggle">
                <input type="checkbox" />
                <span></span>
                <span></span>
                <span></span>
                <ul id="menu">
                    <a href="#"><li>Home</li></a>
                    <a href="#"><li>About</li></a>
                    <a href="#"><li>Info</li></a>
                    <a href="#"><li>Contact</li></a>
                    <a href="https://erikterwan.com/" target="_blank"><li>Show me more</li></a>
                </ul>
            </div>
        </nav>
    </header>
}

export default Header;