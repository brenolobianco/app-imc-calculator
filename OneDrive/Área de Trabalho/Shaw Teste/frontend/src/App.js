import React, { useState, useEffect } from "react";
import axios from "axios";
import "./styles.css";

const UserList = () => {
  const [users, setUsers] = useState([]);
  const [since, setSince] = useState(0);
  const [selectedUser, setSelectedUser] = useState(null);
  const [userRepos, setUserRepos] = useState([]);
  const [userDetails, setUserDetails] = useState(null);

  useEffect(() => {
    const getUsers = async () => {
      try {
        const response = await axios.get(
          `http://localhost:3001/api/users?since=${since}`
        );
        const newUsers = response.data;
        setUsers((prevUsers) => [...prevUsers, ...newUsers]);
      } catch (error) {
        console.error(error);
      }
    };
    getUsers();
  }, [since]);

  const handleLoadMore = () => {
    setSince(users[users.length - 1].id + 1);
  };

  useEffect(() => {
    const getUserRepos = async () => {
      if (selectedUser) {
        const response = await axios.get(
          `http://localhost:3001/api/users/${selectedUser.login}/repos`
        );
        setUserRepos(response.data);
      }
    };
    getUserRepos();
  }, [selectedUser]);
  useEffect(() => {
    const getUserDetails = async () => {
      if (selectedUser) {
        const response = await axios.get(
          `http://localhost:3001/api/users/${selectedUser.login}/details`
        );
        setUserDetails(response.data);
      }
    };
    getUserDetails();
  }, [selectedUser]);

  const handleUserClick = (user) => {
    setSelectedUser(user);
  };

  const handleBackClick = () => {
    setSelectedUser(null);
    setUserRepos([]);
  };

  return (
    <div className="container">
      {!selectedUser ? (
        <>
          <div>
            <h1>User List</h1>
            <ul>
              {users.map((user) => (
                <li key={user.id} onClick={() => handleUserClick(user)}>
                  <span>ID: {user.id}</span>
                  <span>Login: {user.login}</span>
                </li>
              ))}
            </ul>
            <button onClick={handleLoadMore}>Load more users</button>
          </div>
        </>
      ) : (
        <>
          <button onClick={handleBackClick} className="back-button">
            Back to User List
          </button>
          <div className="user-details">
            <h2>User Details</h2>
            <div>ID: {userDetails.id}</div>
            <div>Login: {userDetails.login}</div>
            <div>Profile URL: {userDetails.html_url}</div>
            <div>Date of login creation: {userDetails.created_at}</div>
          </div>
          <table className="repo-table">
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>URL</th>
              </tr>
            </thead>
            <tbody>
              {userRepos.map((repo) => (
                <tr key={repo.id}>
                  <td>{repo.id}</td>
                  <td>{repo.name}</td>
                  <td>
                    <a href={repo.html_url}>{repo.url}</a>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </>
      )}
    </div>
  );
};

export default UserList;
