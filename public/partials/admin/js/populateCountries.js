/**
 * @typedef Country
 * @property {string} flag - url of a country flag.
 */

 /**
  * @type {HTMLDivElement}
  */


/**
 * Fetch countries and populate countries array.
 * If successful, send data to server
 */
async function populateCountries() {

  const errors = document.getElementById('error');
  errors.style.display = 'none';

  const progressBar = document.getElementById('progressBar');
  const progressBarWrapper = document.getElementById('progressBarWrapper');
  progressBarWrapper.style.opacity = 1;

  let progressBarWidth = 0;
  /**
   * @type {HTMLButtonElement}
   */
  const button = document.getElementById('populateCountries');
  button.disabled = true;

  /**
    @type {Array.<Country>}
  */
  const id = setInterval(() => {
    progressBarWidth += 14;
    progressBar.style.width = progressBarWidth + '%';
  }, 100);

  const data = await fetchCountries();
  
  /*
    This part is responsible to return array of promises,
    which will be resolved as soon as file reader returns
    base64 encoded image to stringify.
  */
  const promises = await data.map(async country => {
    const reader = new FileReader();
    const newCountry = {};
    newCountry.name = country.name;
    newCountry.code = country.callingCodes[0];
    newCountry.capital = country.capital; 
    newCountry.language = country.languages[0].nativeName;
    const flag = await fetchFlag(country.flag);

    reader.readAsDataURL(flag);

    return new Promise(res => {
        reader.onload = () => {
          newCountry.flag = reader.result;
          res(newCountry);
      }
    });
  });

  /**
   * @type {array}
   */
  const countries = await Promise.all(promises);
  console.log(countries);

  const formData = new FormData();

  formData.append('countries', JSON.stringify(countries));

  const url = 'http://vladimir.university.com/admin/country/create';

  try {
    const response = await fetch(url, {
      method: 'POST',
      body: formData
    });

    if (progressBarWidth < 100) {
        progressBarWidth = 100;
        progressBar.style.width = 100 + '%';
        clearInterval(id);
      }

    if (!response.ok) {
      const message = await response.json();
      throw new Error(message.message);
    } else {
      window.location.href = 'http://vladimir.university.com/admin';
    }

  } catch (error) {
    progressBarWidth = 0;
    progressBar.style.width = 0 + '%';

    setTimeout(() => {
      progressBarWrapper.style.opacity = 0;
    }, 1000);

    errors.style.display = 'block';
    errors.innerHTML = error.message;
  }

  button.disabled = false;

}


async function fetchCountries() {
  const json = await fetch('https://restcountries.eu/rest/v2/all');
  const data = await json.json();

  return data;
}


/**
 * 
 * @param {string} url 
 */
async function fetchFlag(url) {
  const data = await fetch(url);
  const image = await data.blob();

  return image;
}
