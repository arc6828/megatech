import React, { useState, useEffect, createContext } from 'react';
import NumberApi from './API/NumberApi';

export const NumberContext = createContext();

export const NumberProvider = (props) => {
  
  const initialNumberState = {
    id: null,
    name_doc: "",
    datetime_doc: "",
    number_doc: "",
    number_en: ""
  };
  const [numbers, setNumbers] = useState(initialNumberState)

  const fetchData = () => {
    NumberApi.getAll()
      .then(response => {
        setNumbers(response.data);
        console.log("🚀 ~ file: NumberProvider.js ~ line 28 ~ fetchData ~ response.data", response.data)
      })
      .catch(e => {
        console.log(e);
      });
  }
  useEffect(() => {
    fetchData();
  }, [])

  return (
    <NumberContext.Provider value={[numbers, setNumbers]}>
      {props.children}
    </NumberContext.Provider >
  )
}
