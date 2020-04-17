import React from 'react';
import ReactDOM from 'react-dom';

class LastMonthComparison extends React.Component{
    render() {
        return <div>
            <div className="mb_50">
                <h4>This month compared to last month</h4>
                <br/>
                <div className="clear"></div>
                <div className="row">
                    <div className="col-md-3 col-sm-6">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#2196f3'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M23,10C23,8.89 22.1,8 21,8H14.68L15.64,3.43C15.66,3.33 15.67,3.22 15.67,3.11C15.67,2.7 15.5,2.32 15.23,2.05L14.17,1L7.59,7.58C7.22,7.95 7,8.45 7,9V19A2,2 0 0,0 9,21H18C18.83,21 19.54,20.5 19.84,19.78L22.86,12.73C22.95,12.5 23,12.26 23,12V10M1,21H5V9H1V21Z"></path>
                                </svg>
                                Likes
                            </h2>
                            <p>
                                0% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        strokeWidth="2" strokeLinecap="round"
                                        strokeLinejoin="round"
                                        className="feather feather-arrow-up">
                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                <polyline points="5 12 12 5 19 12"></polyline>
                            </svg>
                            </p>
                        </div>
                    </div>
                    <div className="col-md-3 col-sm-6">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#f44336'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M19,15H23V3H19M15,3H6C5.17,3 4.46,3.5 4.16,4.22L1.14,11.27C1.05,11.5 1,11.74 1,12V14A2,2 0 0,0 3,16H9.31L8.36,20.57C8.34,20.67 8.33,20.77 8.33,20.88C8.33,21.3 8.5,21.67 8.77,21.94L9.83,23L16.41,16.41C16.78,16.05 17,15.55 17,15V5C17,3.89 16.1,3 15,3Z"></path>
                                </svg>
                                Dislikes
                            </h2>
                            <p>
                                0% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        strokeWidth="2" strokeLinecap="round"
                                        strokeLinejoin="round"
                                        className="feather feather-arrow-up">
                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                <polyline points="5 12 12 5 19 12"></polyline>
                            </svg>
                            </p>
                        </div>
                    </div>
                    <div className="col-md-3 col-sm-6">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#f2b92b'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M10,16.5V7.5L16,12M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"></path>
                                </svg>
                                Views
                            </h2>
                            <p>
                                0% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        strokeWidth="2" strokeLinecap="round"
                                        strokeLinejoin="round"
                                        className="feather feather-arrow-up">
                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                <polyline points="5 12 12 5 19 12"></polyline>
                            </svg>
                            </p>
                        </div>
                    </div>
                    <div className="col-md-3 col-sm-6">
                        <div className="vp_mn_dash_stats">
                            <h2 style={{color: '#6abd46'}}>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                     viewBox="0 0 24 24">
                                    <path fill="currentColor"
                                          d="M12,23A1,1 0 0,1 11,22V19H7A2,2 0 0,1 5,17V7A2,2 0 0,1 7,5H21A2,2 0 0,1 23,7V17A2,2 0 0,1 21,19H16.9L13.2,22.71C13,22.89 12.76,23 12.5,23H12M3,15H1V3A2,2 0 0,1 3,1H19V3H3V15Z"></path>
                                </svg>
                                Comments
                            </h2>
                            <p>
                                0% <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        strokeWidth="2" strokeLinecap="round"
                                        strokeLinejoin="round"
                                        className="feather feather-arrow-up">
                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                <polyline points="5 12 12 5 19 12"></polyline>
                            </svg>
                            </p>
                        </div>
                    </div>
                </div>
                <div className="clear"></div>
            </div>
            <div className="clear"></div>
        </div>
    }
}

export default LastMonthComparison;
