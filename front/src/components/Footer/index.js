import React from 'react'
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faFacebook, faTwitter } from '@fortawesome/free-brands-svg-icons'

import './style.sass';

const Footer = () => {
    return <div className="foot">
        <FontAwesomeIcon icon={faFacebook} className="footer-icon"/>
        <FontAwesomeIcon icon={faTwitter} className="footer-icon"/>
        
    </div>
}

export default Footer;