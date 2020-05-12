import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";

class Comments extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            totalComments: this.props.totalComments
        }
    }

    componentDidMount() {
        axios.get('get_total_comments')
            .then((res) => {
                this.setState({totalComments: res.data.totalComments})
            })
            .catch((err) => {
                console.log(err)
            })
    }

    render() {
        return <div>
            <div>
                <div className="row">
                    <div className="col-md-4">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#6abd46'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7A2,2 0 0,1 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.89 12.76,23 12.5,23H12M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z"></path>
                                </svg>
                                Comments Today
                            </h2>
                            <p>{this.state.totalComments}</p>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#6abd46'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7A2,2 0 0,1 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.89 12.76,23 12.5,23H12M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z"></path>
                                </svg>
                                Comments This Month
                            </h2>
                            <p>0</p>
                        </div>
                    </div>
                    <div className="col-md-4">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#6abd46'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7A2,2 0 0,1 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.89 12.76,23 12.5,23H12M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z"></path>
                                </svg>
                                Comments This Year
                            </h2>
                            <p>0</p>
                        </div>
                    </div>
                </div>
                <div className="clear"></div>
                <br/>
            </div>
            <div>
                <h4>Latest Comments</h4>
                <br/>
                <div className="form-group" id="comments_container">

                    <div className="clear"></div>
                </div>
                <div className="clear"></div>
                <br/>
            </div>
        </div>
    }
}

export default Comments;
