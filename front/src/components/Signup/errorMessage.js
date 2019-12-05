import React from "react";

export default function ErrroMessage({ error }) {
  if (error) {
    switch (error.type) {
      case "required":
        return <p className="errors-messages">Ce champ est requis</p>;
      case "minLength":
        return <p>Ce champ doit avoir plus de 2 caractères</p>;
      case "maxLength":
        return <p>Ce champ doit avoir moins de 24 caractères</p>;
      case "pattern":
        return <p className="errors-messages">Entrez une adresse mail valide</p>;
      case "min":
        return <p>Minmium age is 18</p>;
      case "validate":
        return <p>Pseudo déjà utilisé</p>;
      case "samePassword":
        return <p className="errors-messages">Vos mots de passes doivent etre identique</p>
    case "checkboxNeedTrue":
        return <p>Vous devez accepter les conditions d'utilisation générale</p>;
      default:
        return null;
    }
  }

  return null;
}