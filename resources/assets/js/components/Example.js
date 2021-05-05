import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import Index from '../components/company/Index';
import Create from '../components/company/Create';

const Example = () => {
  return (
    <BrowserRouter>
      <Switch>
        <Route path="/create">
          <Create />
        </Route>
        <Route path="/">
          <Index />
        </Route>
      </Switch>
    </BrowserRouter>
  )
}

export default Example
if (document.getElementById('example')) {
  ReactDOM.render(<Example />, document.getElementById('example'));
}