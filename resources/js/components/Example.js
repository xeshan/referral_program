import React from 'react';
import ReactDOM from 'react-dom';
import {BrowserRouter as Router, Routes,Route} from "react-router-dom";
import MultiEmail from "./MultiEmail";


function Example() {
    return (
        <Router>
        <>
            <div className = "container mt-2">
                <div className="row">
                    <div className="col-md-8">
                        <Routes>
                            <Route path="/referrals" exact element={<MultiEmail/>}  />
                        </Routes>
                    </div>
                </div>
            </div>
           
        </>
        </Router>
    );
}

export default Example;

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
