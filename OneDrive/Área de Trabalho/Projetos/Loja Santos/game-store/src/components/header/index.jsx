import { HeaderBox } from "./styles";

function Header() {
  return (
    <HeaderBox>
      
      <nav className="header-nav">
        <a href="">Xbox</a>
        <a href="">Playstation</a>
        <a href="">Nintendo</a>
        <a href="">PC</a>
      </nav>
      <div className="header-login">
        <img src="" alt="iamgem" />
        <a href="">Fazer Login</a>
      </div>
    </HeaderBox>
  );
}

export default Header;
