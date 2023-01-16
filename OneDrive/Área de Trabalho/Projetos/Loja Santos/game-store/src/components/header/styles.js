import styled from "styled-components";

export const HeaderBox = styled.header`
  width: 100%;
  height: 80px;
  background: #6d6c80;
  display: flex;
  justify-content: center;
  align-items: flex-end;

  a {
    color: white;
    text-decoration: none;
    font-size: 15px;
  }
  .header-nav {
    width: 400px;
    height: 30px;

    display: flex;
    justify-content: space-between;

    .header-login {
      width: 100px;
      margin-left: 30px;
    }
  }
`;
