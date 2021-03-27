<template>
	<div class="tm-page-wrap mx-auto" id="content">
        <section class="tm-banner">
            <div class="tm-container-outer tm-banner-bg">
                <div class="container">

                    <div class="row tm-banner-row tm-banner-row-header">
                        <div class="col-xs-12">
                            <div class="tm-banner-header">
                                <h1 class="text-uppercase tm-banner-title">Let's begin</h1>
                                <img src="img/dots-3.png" alt="Dots">
                                <p class="tm-banner-subtitle">We assist you to choose the best.</p>      
                            </div>    
                        </div>  <!-- col-xs-12 -->                      
                    </div> <!-- row -->
                    <div class="row tm-banner-row" id="tm-section-search">

                        <div class="tm-search-form tm-section-pad-2">
                            <div class="form-row tm-search-form-row">                                
                                <div class="form-group tm-form-group tm-form-group-pad tm-form-group-1">
                                    <label for="inputCity">Choose Your Destination</label>
                                    <select class="form-control tm-select" id="inputCity">
                                        <option value="Tokyo">Tokyo</option>
                                        <option value="Yokohama">Yokohama</option>
                                        <option value="Kyoto">Kyoto</option>
                                        <option value="Osaka">Osaka</option>
                                        <option value="Sapporo">Sapporo</option>
                                        <option value="Nagoya">Nagoya</option>
                                    </select>     
                                </div>
                                <div class="form-group tm-form-group tm-form-group-1 col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="btnSubmit">&nbsp;</label>
                                        <button 
                                        	class="btn btn-primary tm-btn tm-btn-search text-uppercase" 
                                        	id="btnSubmit"
                                        	@click="showSubContent">
                                    			Get Information
                                    	</button>
                                     </div>                                    
                                 
                                </div>
                            </div>                               
                        </div>                             

                    </div>
                    <div class="tm-banner-overlay"></div>
                </div>                  
            </div>               
        </section>
        <section class="hidden" id="sub-content">
            <div class="site-content">
                <h5 class="forecast-container m-0 p-2 text-center" colspan="12">WEATHER FORECAST</h5>
                <div class="forecast-table">
                    <div class="w-100 p-0 m-0">
                        <div class="forecast-container" id="foreCastContainer">
                            <div class="today forecast">
                                <div class="forecast-header">
                                    <div class="day" id="today">Monday</div>
                                    <div class="date" id="date">6 Oct</div>
                                </div> <!-- .forecast-header -->
                                <div class="forecast-content">
                                    <div class="location" id="location">New York</div>
                                    <div class="degree">
                                        <div class="num"><label id="celsius">23</label><sup>o</sup>C</div>
                                        <div class="forecast-icon">
                                            <img id="headerImage" src="img/icons/icon-1.svg" alt="" width=90>
                                        </div>  
                                    </div>
                                    <span><img src="img/icon-umberella.png" alt="">20%</span>
                                    <span id="windSpeed"><img src="img/icon-wind.png"  alt="">18km/h</span>
                                    <span><img src="img/icon-compass.png" alt="">East</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        	<section class="tm-container-outer tm-bg-gray">              
                <table class="flatTable">
                  <tr class="titleTr" id="table">
                    <td class="titleTd text-center" colspan="12">TOURIST SPOTS</td>
                    <tr class="headingTr">
                      <td>NAME</td>
                      <td>CATEGORY</td>
                      <td>ADDRESS</td>
                    </tr>
                    <tr 
                        v-for="(venue, index) in venues"
                        :key="index"
                    >
                        <td>{{venue.name}}</td>
                        <td>{{venue.categories[0].name}}</td>
                        <td>{{venue.location.address}} {{venue.location.crossStreet}} </td>
                    </tr>
                  </tr>
                </table>           
            </section>
        </section>
    </div>
</template>         
<script type="text/javascript">
	export default {
        data: () => ({
            venues: []
        }),
		methods: {
				showSubContent(){
                $(".subForeCast").remove();
				const cityName = $('#inputCity').val();
				$('#sub-content').removeClass('hidden');
				$('#city').text(cityName);
                $('#downloadDocumentDialog').modal('show')
                fetch(`https://api.foursquare.com/v2/venues/search?near=${cityName}, jp&client_id=PZIX2NVJLDMP2ETWOJMH1Q1HL1BVTYJBJHGLGVTCBTX3CHG3&client_secret=UIJ4ESLLYHC5W4HYOT5NHHC40KB1UA3ZGQW4ISXE2VLUUOJZ&v=20210324&lang=eng`).then(res => res.json()).then(data => {
                        if(data)
                        {
                            this.venues = data.response.venues;      
                        }
                        else
                        {
                            alert("Something went wrong please try again later");
                        }
                })
                fetch(`https://api.openweathermap.org/data/2.5/forecast?q=${cityName}&appid=47134f55be652383987dd74e12a1610e`).then(res => res.json()).then(data => {

                        const weatherDesc = data.list[0].weather[0].description;
                        const date = data.list[0].dt_txt.slice(0, 10);
                        const tempKelvin = data.list[0].main.temp;
                        const tempCelsius = tempKelvin - 273.15;
                        const Day = getDayName(date, "en-US");
                        const windSpeed = data.list[0].wind.speed;
                        $('#today').text(Day);
                        $('#date').text(date);
                        $('#location').text(cityName);
                        $('#celsius').text(Math.round(tempCelsius).toFixed(0));
                        $('#windSpeed').text(windSpeed + " m/s");
                        for (let i = 7; i <= data.list.length; i+=8) {
                            const weatherDesc = data.list[i].weather[0].description;
                            const date = data.list[i].dt_txt.slice(0, 10);
                            const tempKelvin = data.list[i].main.temp;
                            const tempCelsius = tempKelvin - 273.15;
                            const Day = getDayName(date, "en-US");
                            const div =  `
                                <div class="forecast subForeCast">
                                    <div class="forecast-header">
                                        <div class="day">${Day}</div>
                                    </div>
                                    <div class="forecast-content">
                                        <div class="forecast-icon">
                                            <img id=${Day} src="img/icons/icon-3.svg" alt="" width=48>
                                        </div>
                                        <div class="degree"><label>${(tempCelsius).toFixed(0)}</label><sup>o</sup>C</div>
                                        
                                    </div>
                                </div>
                            ` 
                            document.getElementById("foreCastContainer").innerHTML += div;
                            if (weatherDesc == "broken clouds") {
                                $("#headerImage").attr("src", "img/icons/icon-5.svg");
                                $("#"+ Day).attr("src", "img/icons/icon-5.svg");

                            }
                            else if(weatherDesc == "light rain"){
                                $("#headerImage").attr("src", "img/icons/icon-13.svg");
                                $("#"+ Day).attr("src", "img/icons/icon-13.svg");   
                            }
                            else if(weatherDesc == "overcast clouds"){
                                $("#headerImage").attr("src", "img/icons/icon-7.svg");
                                $("#"+ Day).attr("src", "img/icons/icon-7.svg");   
                            }
                            else if(weatherDesc == "scattered clouds"){
                                $("#headerImage").attr("src", "img/icons/icon-6.svg");
                                $("#"+ Day).attr("src", "img/icons/icon-6.svg");   
                            } 
                            else if(weatherDesc == "few clouds"){
                                $("#headerImage").attr("src", "img/icons/icon-5.svg");
                                $("#"+ Day).attr("src", "img/icons/icon-5.svg");   
                            } 
                            else if(weatherDesc == "moderate rain"){
                                $("#headerImage").attr("src", "img/icons/icon-11.svg");
                                $("#"+ Day).attr("src", "img/icons/icon-11.svg");   
                            }
                        }
                                
                })
            }
        }
    }

    function getDayName(dateStr, locale){
        var date = new Date(dateStr);
        return date.toLocaleDateString(locale, { weekday: 'long' });        
    }
	
</script>