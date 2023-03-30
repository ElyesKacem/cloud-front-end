import React from "react";
import { Toaster } from "react-hot-toast";
import SignUp from "./component/SignUp";

function App() {
  return (
    <React.Fragment>
      <Toaster position="top-center" />
      <SignUp />
    </React.Fragment>
  );
}

export default App;
