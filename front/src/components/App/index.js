/**
 * Imports de dépendances
 */
import React from 'react';



/**
 * Imports locaux
 */
//import 'bootstrap/dist/css/bootstrap.min.css';

import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCoffee, faBars } from '@fortawesome/free-solid-svg-icons'
// Composants React
// import VoteWidget from 'src/components/VoteWidget';
// import TestingHooks from 'src/components/TestingHooks';
import Header from 'src/components/Header';
import Footer from 'src/components/Footer';
import HomeMain from 'src/components/HomeMain';
import Signin from 'src/components/Signin';


// Données
// Styles et assets
import './app.sass';

/**
 * Code
 */
const App = () => {
  return <div id="app">
   <Header />
   <HomeMain />
   {/* <Signin /> */}
   <Footer />
  </div>;
}

/**
 * Export
 */
export default App;
