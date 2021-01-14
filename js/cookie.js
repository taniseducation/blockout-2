// function to set cookie
const setCookie = (cookieName, cookieValue, cookieExpiresDays) => {
  const date = new Date();
  date.setTime(date.getTime() + (cookieExpiresDays * 24 * 60 * 60 * 1000));
  const expires = `expires=${date.toUTCString()}`; 
  const path = `path=/`;
  document.cookie = `${cookieName}=${cookieValue};${expires};${path}`;
};

// function to get all blockout cookies
const getBlockoutCookies = () => {
  let blockoutCookies = [];
  const allCookies = document.cookie.split(';');

  allCookies.forEach(eachCookie => {
    const eachCookieName = eachCookie.trim().split('=')[0];
    const eachCookieValue = eachCookie.trim().split('=')[1];

    if(eachCookieName.substring(0, 3) == "gID") {
      blockoutCookies.push({
        name : eachCookieName,
        value : eachCookieValue
      });
    }
  });

  return blockoutCookies;
};

// function to get single blockout cookie
const getSingleBlockoutCookie = cookieName => {
  let cookieValue = '';

  getBlockoutCookies().forEach(eachBlockoutCookie => {
    if(eachBlockoutCookie.name == cookieName) {
      cookieValue = eachBlockoutCookie.value;
    }
  });

  return cookieValue;
};

// function to get lowest blockout cookie score
const getMinBlockoutCookieScore = () => {
  let minScore = Number.POSITIVE_INFINITY;
  let minScoreID = null;

  getBlockoutCookies().forEach(eachBlockoutCookie => {
    const eachBlockoutCookieScore = parseInt(eachBlockoutCookie.value.split('|')[4]);
    if(eachBlockoutCookieScore < minScore) {
      minScore = eachBlockoutCookieScore;
      minScoreID = eachBlockoutCookie.name;
    }
  });

  return {
    minScoreID : minScoreID,
    minScore : minScore
  };
};

// function to update blockout cookie
const createUpdateBlockoutCookie = () => {
  const cookieName = `gID-${game.id}`;
  const cookieValue = `${game.playerName}|${game.set}|${game.pit}|${game.level}|${game.score}|${game.playedAt}|${game.countryName}|${game.ipAddress}`;
  setCookie(cookieName, cookieValue, 10000); // invoking setCookie() for update purpose
};

// functon to get last blockout cookie player name
const getLastBlockoutCookiePlayerName = () => {
  let lastPlayerName = '';
  getBlockoutCookies().forEach(eachBlockoutCookie => {
    const eachCookiePlayerName = eachBlockoutCookie.value.split('|')[0];
    if(eachCookiePlayerName.length) {
      lastPlayerName = eachCookiePlayerName;
    }
  });

  return lastPlayerName;
};

// function to filter blockout cookie to keep saved max 100
const filterBlockOutCookies = () => {
  if(getBlockoutCookies().length >= 100) {
    if(getMinBlockoutCookieScore.minScore < parseInt(game.score)) {
      createUpdateBlockoutCookie(); // invoking createUpdateBlockoutCookie() to save score in cookie
      setCookie(getMinBlockoutCookieScore.minScoreID, '', -1); // invoking setCookie() to delete the min scored cookie
    }
  }
};
