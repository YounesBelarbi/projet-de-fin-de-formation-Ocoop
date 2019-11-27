/**
 * Pour écrire les tests ci-dessous, deux outils ont été utilisés :
 *
 * - Mocha (https://mochajs.org/) => permet de lancer une série (« suite ») de tests
 * - ChaiJS (https://www.chaijs.com) => permet d'écrire des assertions (== des vérifs)
 *
 * Un test est concrètement une fonction, qui fait une ou plusieurs vérifications.
 * Par exemple, un test va appeler une fonction, et comparer sa valeur de retour
 * avec une valeur pré-déterminée. S'il y a égalité, le test passe, sinon il échoue.
 *
 * Le résultat de tous les tests actifs est résumé dans un rapport de test.
 */
import { expect } from 'chai';
// Pas besoin d'importer 'mocha', cf. package.json


// "describe" => décrit une série de tests
describe('something', function() {
  // "it" => décrit un test spécifique
  it('should be true', function() {
    expect(true).to.equal(true);
  });

  xit('should not be false', function() {
    expect(true).not.to.equal(false);
  });
});
