import React, { Component } from 'react';
import logo from './logo.svg';
import './App.css';
import axios from 'axios';

class App extends Component {

  constructor() {
    super();

    this.state = {
      movies: []
    }
  }

  componentWillMount() {

    axios.get('http://localhost:5000/')
      .then((response) => {
          console.log(response);
          this.setState({movies: response.data});
      })
      .catch( (error) => {
        console.log('error');
        console.log(error.response);
      })
  }

  setGrade = (movie_id, grade) => {
    
    axios.post('http://localhost:5000/set-grade?movie_id=' + movie_id + '&grade=' + grade)
      .then((response) => {
          console.log(response);
          if (response.data === 'success') {
                this.setState({movies: this.state.movies.map( movie => {
                    return movie.id === movie_id ? Object.assign({}, movie, { grade: grade }) : movie
                    })
                })
          }
      })
      .catch( (error) => {
        console.log('error');
        console.log(error.response);
      })

  }

  render() {
    return (
      <div className="container">
          <h2>Movies admin</h2>
          <table className="table table-hover">
              <thead>
              <tr>
                  <th>Movie</th>
                  <th>Grade</th>
                  <th>Change grade</th>
              </tr>
              </thead>
              <tbody>

              {
                  this.state.movies.map(movie => {
                      return (
                        <tr>
                            <td>{ movie.name }</td>
                            <td>{ movie.grade }</td>
                            <td> <div className="dropdown">
                                    <button className="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Give a grade
                                        <span className="caret"></span></button>
                                    <ul className="dropdown-menu">
                                        {

                                          [1, 2 ,3 ,4 ,5 ,6 ,7 ,8 ,9 ,10].map(i => {
                                            return <li><a href="#" style={{textAlign: "center"}} onClick={() => this.setGrade(movie.id, i)}>{ i }</a></li>
                                          })
                                        }
                                    </ul>
                                </div></td>
                        </tr>
                      )
                  })
                }

              </tbody>
          </table>
      </div>
    );
  }
}

export default App;
