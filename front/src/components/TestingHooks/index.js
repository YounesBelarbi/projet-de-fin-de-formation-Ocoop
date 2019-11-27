import React, { useEffect } from 'react';
import emailValidator from 'email-validator';
// import useDocumentTitle from '@rehooks/document-title';

import { useInput } from 'src/hooks';

const TestingHooks = () => {
  const emailInputTools = useInput('', 'Votre email', {
    validate: emailValidator.validate
  });

  const passwordInputTools = useInput('', 'Votre mot de passe', {
    validate: (password) => {
      return password === 'testtest';
    }
  });

  const number = Math.random();

  // useEffect reproduit une logique de componentDidMount+componentDidUpdate
  // => ça gère aussi componentWillUnmount
  useEffect(() => {
    console.log('effet de bord ?');
    document.title = emailInputTools.props.value;
  }, []);

  return <form>
    <input type='email' {...emailInputTools.props} />
    <span>{emailInputTools.isValid ? 'OK' : 'KO'}</span>
    <input type='password' {...passwordInputTools.props} />
    <span>{passwordInputTools.isValid ? 'OK' : 'KO'}</span>
  </form>;
};

export default TestingHooks;
