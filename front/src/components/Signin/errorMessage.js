import React from "react";

export default function ErrroMessage({ error }) {
  if (error) {
    switch (error.type) {
      case "required":
        return <p>Ce champ est requis</p>;
      case "validate":
        return <p>Pseudo déjà utilisé</p>;
      default:
        return null;
    }
  }

  return null;
}