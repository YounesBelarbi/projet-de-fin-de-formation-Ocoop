/**
 * Imports de dépendances
 */
import React from 'react';
import { BrowserRouter as Router, Route, Link, Switch, Redirect } from 'react-router-dom'



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
import Signup from 'src/components/Signup';
import ResetPassword from 'src/components/ResetPassword';

// Données
// Styles et assets
import './app.sass';

/**
 * Code
 */
const App = () => {
  return <Router>
            <div id="app">
              <Header />
              <main>
              <Switch>
                <Route path="/" exact component={HomeMain} />
                <Route path="/signin" component={Signin} />
                <Route path="/signup" component={Signup} />
                <Redirect from='/signup/' to="/signin/" />
                <Route path="/resetpassword" component={ResetPassword} />
                
              </Switch>
              </main>
              <Footer />
          </div>
        </Router>;
}
/**
 * Export
 */
export default App;
