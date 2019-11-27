/**
 * Imports de dépendances
 */
import React from 'react';

/**
 * Imports locaux
 */
// Composants React
import VoteWidget from 'src/components/VoteWidget';
import TestingHooks from 'src/components/TestingHooks';
// Données
// Styles et assets
import './app.sass';

/**
 * Code
 */
const App = ({ promo }) => {
  return <div id="app">
    <h1 id="app-title">Modèle React</h1>
    <p id="app-content"><em>Salut</em> {promo} !</p>
    <VoteWidget />
    <TestingHooks />
  </div>;
}

/**
 * Export
 */
export default App;
