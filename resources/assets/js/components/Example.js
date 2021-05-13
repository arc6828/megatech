import React from 'react';
import ReactDOM from 'react-dom';
import { NumberProvider } from '../NumberProvider';
import Number from './Number';

const Example = () => {

  return (
    <NumberProvider>
      <Number />
    </NumberProvider>

  )
}

export default Example;

if (document.getElementById('example')) {
  ReactDOM.render(<Example />, document.getElementById('example'));
}