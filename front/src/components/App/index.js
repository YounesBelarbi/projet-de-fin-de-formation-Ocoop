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
// import CheckToken from 'src/components/CheckToken';
import Header from 'src/components/Header';
import Footer from 'src/components/Footer';
import HomeMain from 'src/components/HomeMain';
import Signin from 'src/components/Signin';
import Signup from 'src/components/Signup';
import ResetPassword from 'src/components/ResetPassword';
import HeaderDashboard from 'src/components/HeaderDashboard';
import Dashboard from 'src/components/Dashboard';



// Données
// Styles et assets
import './app.sass';

/**
 * Code
 */
const App = () => {
  return <Router>
            <div id="app">
              <main>
              {/* <CheckToken/> */}
              <Switch>
                <Route path="/" exact>
                  <Header/>
                  <HomeMain/>
                  <Footer/> 
                </Route>
                <Route path="/signin">
                  <Header/>
                  <Signin/>
                  <Footer/> 
                </Route>
                <Route path="/signup">
                  <Header/>
                  <Signup/>
                  <Footer/> 
                </Route>
                <Route path="/dashboard">
                  <HeaderDashboard/>
                  <Dashboard/> 
                </Route>
                <Route path="/resetpassword" >
                  <Header/>
                  <ResetPassword/>
                  <Footer/> 
                </Route>
                <Redirect from='/signup/' to="/signin/" />
              </Switch>
              </main>
          </div>
        </Router>;
}
/**
 * Export
 */
export default App;
