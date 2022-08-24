import React from 'react';
import './style.css'

class MultiEmail extends React.Component{
state = {
    items: [],
    value: "",
    error: null
  };

  handleKeyDown = evt => {
    if (["Enter", "Tab", ","].includes(evt.key)) {
      evt.preventDefault();

      var value = this.state.value.trim();

      if (value && this.isValid(value)) {
        this.setState({
          items: [...this.state.items, this.state.value],
          value: ""
        });
      }
    }
  };

  handleChange = evt => {
    this.setState({
      value: evt.target.value,
      error: null
    });
  };

  handleDelete = item => {
    this.setState({
      items: this.state.items.filter(i => i !== item)
    });
  };

  handlePaste = evt => {
    evt.preventDefault();

    var paste = evt.clipboardData.getData("text");
    var emails = paste.match(/[\w\d\.-]+@[\w\d\.-]+\.[\w\d\.-]+/g);

    if (emails) {
      var toBeAdded = emails.filter(email => !this.isInList(email));

      this.setState({
        items: [...this.state.items, ...toBeAdded]
      });

    }
  };

  isValid(email) {
    let error = null;

    if (this.isInList(email)) {
      error = `${email} has already been added.`;
    }

    if (!this.isEmail(email)) {
      error = `${email} is not a valid email address.`;
    }

    if (error) {
      this.setState({ error });

      return false;
    }

    return true;
  }

  isInList(email) {
    return this.state.items.includes(email);
  }

  isEmail(email) {
    return /[\w\d\.-]+@[\w\d\.-]+\.[\w\d\.-]+/.test(email);
  }
handleInput = (e) => {
    this.setState({[e.target.name]: e.target.value});
  }

  sendFunc = (e) => {
    // e.preventDefault();
    const res =  axios.post("/invite", this.state.items);
  }
render(){
   return (
   <>
      <main className="wrapper">
        {this.state.items.map(item => (
          <div className="tag-item" key={item}>
            {item}
            <button
              type="button"
              className="button"
              onClick={() => this.handleDelete(item)}
            >
              &times;
            </button>
          </div>
        ))}
        <form onSubmit={this.sendFunc}>
        <input
          className={"input " + (this.state.error && " has-error")}
          value={this.state.value}
          placeholder="Type or paste email,press `Enter` and press Invite Button"
          onKeyDown={this.handleKeyDown}
          onChange={this.handleChange}
          onPaste={this.handlePaste}
        />

        {this.state.error && <p className="error">{this.state.error}</p>}
        <div class="form-group sb-btn" >
            <input type="submit" class="btn btn-primary" value="Send Invite" />
          </div>
        </form>
      </main>
      </>
);
  }
}
export default MultiEmail;

