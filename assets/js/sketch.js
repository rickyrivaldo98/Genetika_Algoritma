// Carla de Beer
// Created: May 2017
// Genetic algorithm to find an optimised solution to the Travelling Salesman Problem.
// The program dynamically reads in city data from a file and calculates the shortest distance it can find, linking all cities.
// The actual physical distance on the route, calculated as the Haversine distance, is also shown.
// Specifiable parameters: crossover rate, mutation rate, population size, max. no. iterations, elitism generation gap.
// City data obtained from: https://gist.github.com/Miserlou/c5cd8364bf9b2420bb29
// The crossover strategy makes use of Modified Order Crossover (MOX), as described in:
// http://citeseerx.ist.psu.edu/viewdoc/download?doi=10.1.1.91.9167&rep=rep1&type=pdf
// Haversine distance formula:
// http://stackoverflow.com/questions/27928/calculate-distance-between-two-latitude-longitude-points-haversine-formula
// Map from MapBox; https://www.mapbox.com/api-documentation/#retrieve-a-sprite-image-or-json

var numCities;
var generation = 0;
var maxGeneration = 1500;
var numPop = 3000;
var crossoverRate = 75;
var mutationRate = 25;
var generationGap = 20.0;
var sumHaversine = 0.0;
var converge = 0;
var randomStrategy;

var lonList = [],
	latList = [],
	nameList = [];
var pitch = 0;
var clat = -5.0556;
var clon = 110.42142;
var zoom = 5;

var path = [],
	pathTrue = [];
var populationList = [];
var record = 0.0;

var mapImage, map;
var imageWidth = 512 * 2,
	imageHeight = 512 * 1.25;
//var imageWidth = 512 * 2.5, imageHeight = 512 * 1.25;
var cityData = [];

//Proses GA dengan button (Belum selesai)
$(document).ready(function () {
	$("#proses").click(function () {
		$("#log").val("");
		var textContent = "~Proses Algoritma Gentika~\n";
		$("#log").val(textContent);
		temp = $("#log").val();

		textContent = temp + "\nCrossover Rate\t: ";
		crossoverRate = $("#cr option:selected").text();
		$("#log").val(textContent + crossoverRate);
		temp = $("#log").val();

		textContent = temp + "\nMutation Rate\t\t: ";
		mutationRate = $("#mr option:selected").text();
		$("#log").val(textContent + mutationRate);
		temp = $("#log").val();

		textContent = temp + "\nPopulation Size\t: ";
		numPop = $("#ps option:selected").text();
		$("#log").val(textContent + numPop);
		temp = $("#log").val();

		textContent = temp + "\nMax Generation\t: ";
		maxGeneration = $("#mg option:selected").text();
		$("#log").val(textContent + maxGeneration);
		temp = $("#log").val();

		for (var i = 0, l = latList.length; i < l; ++i) {
			var cx = webMercatorX(clon);
			var cy = webMercatorY(clat);
			var x = webMercatorX(lonList[i]) - cx;
			var y = webMercatorY(latList[i]) - cy;
			path.push(new City(x, y, nameList[i]));
			pathTrue.push(new City(lonList[i], latList[i], nameList[i]));
		}

		populationList = [];
		for (var i = 0; i < numPop; ++i) {
			populationList.push(new Route(path, true));
		}

		randomStrategy = generate();
		// randomStrategy = new RandomStrategy(
		// 	populationList,
		// 	numPop,
		// 	crossoverRate,
		// 	mutationRate,
		// 	generationGap,
		// 	numCities
		// );

		textContent = temp + "\n\n~Initial Population~ \n";
		$("#log").val(textContent);
		temp = $("#log").val();
		textContent = printInitialPopulation(populationList);
		$("#log").val(temp + textContent);
		console.log(randomStrategy);

		randomStrategy.runGA();
		// generation++;
		console.log(randomStrategy);
	});
});

function generate() {
	randomStrategy = new RandomStrategy(
		populationList,
		numPop,
		crossoverRate,
		mutationRate,
		generationGap,
		numCities
	);
	return randomStrategy;
}
function printInitialPopulation(populationList) {
	var print = "";
	for (var i = 0; i < populationList.length; ++i) {
		var num = "\nRoute-" + (i + 1) + ":\n";
		// $("#log").val(temp);
		var route = "";
		for (var j = 0; j < populationList[i].chromosome.length; ++j) {
			var name = populationList[i].chromosome[j].name;
			route += name + ", ";
			// $("#log").val(route);
		}
		print += num + route;
	}
	return print;
}

function preload() {
	//nama file
	var name = document.getElementById("name").value;
	// console.log(name);

	//path file
	var url = document.getElementById("url").value;
	// console.log(url);

	loadJSON(url, processJSON);

	// Dynamically load the map from the MapBox API
	// mapboxgl.accessToken =
	// 	"pk.eyJ1IjoiYW5nZ2FkaGFybWE2MCIsImEiOiJja2Z3aWs1cGswY2p2MnFub3k3anZjaHRvIn0.1rstxyC5mH5Qfrpv92UAtg";
	// var map = new mapboxgl.Map({
	// 	container: "map",
	// 	style: "mapbox://styles/anggadharma60/ckg06z7mt1x1x19of5d6mwu5i", // stylesheet location
	// 	center: [110.42142, -7.0556], // starting position [lng, lat]
	// 	zoom: 14, // starting zoom
	// });
	mapImage = loadImage(
		"https://api.mapbox.com/styles/v1/mapbox/light-v9/static/" +
			clon +
			"," +
			clat +
			"," +
			zoom +
			"," +
			pitch +
			"/" +
			imageWidth +
			"x" +
			imageHeight +
			"?access_token=pk.eyJ1IjoiYW5nZ2FkaGFybWE2MCIsImEiOiJja2Z3aWs1cGswY2p2MnFub3k3anZjaHRvIn0.1rstxyC5mH5Qfrpv92UAtg"
	);
}

function processJSON(data) {
	// cara baca geojson
	// console.log(data.features[0].geometry.coordinates[0]);
	// console.log(data.features[0].geometry.coordinates[1]);
	// console.log(data.features[0].properties.name);

	//cara baca array geosjon
	cityData = data.features;
	// console.log(cityData);
	//cara baca panjang array geojson
	numCities = data.features.length;

	// console.log(numCities);
	// Set header text
	// var header1 = document.getElementById("header1");
	// var text = "TSP Distance Calculator";
	// header1.innerText = text;
	// var textWidth = getWidthOfText(text, "Arial", "15px");
	// header1.style.left = window.innerWidth / 2 - textWidth / 2 + "px";

	// // Set header text
	// var header2 = document.getElementById("header2");
	// text = "Travelling to the " + numCities + " largest cities in the US";
	// header2.innerText = text;
	// textWidth = getWidthOfText(text, "Arial", "13px");
	// header2.style.left = window.innerWidth / 2 - textWidth / 2 + "px";

	// Parse the JSON data and set the global arrays
	parse(data.features, lonList, latList, nameList);

	init();
}

function setup() {
	// Centre the canvas
	var cnv = createCanvas(imageWidth, imageHeight);
	var x = (windowWidth - width) / 2;
	var y = (windowHeight - height) / 2 - 20;
	cnv.position(x + 150, y + 300);
}

function draw() {
	translate(width * 0.5, height * 0.5);
	imageMode(CENTER);
	image(mapImage, 0, 0);
	fill(255, 0, 0);
	noStroke();

	// Run GA
	randomStrategy.runGA();
	generation++;

	if (Math.abs(record - randomStrategy.optimalValue) > 0.00001) {
		converge = generation;
	}

	record = randomStrategy.optimalValue;

	// Draw route
	beginShape();
	noFill();
	stroke(255, 64, 64, 200);
	strokeWeight(2);
	for (var i = 0, l = randomStrategy.getBestSolution().length; i < l; ++i) {
		stroke(255, 64, 64, 200);
		vertex(
			randomStrategy.getBestSolution()[i].lon,
			randomStrategy.getBestSolution()[i].lat
		);
	}
	endShape();

	// Draw city dots
	var cx = webMercatorX(clon);
	var cy = webMercatorY(clat);

	for (var i = 0, l = cityData.length; i < l; ++i) {
		var lon = cityData[i].longitude;
		var lat = cityData[i].latitude;

		var x = webMercatorX(lon) - cx;
		var y = webMercatorY(lat) - cy;
		strokeWeight(1);
		fill(250, 170);
		ellipse(x, y, 8, 8);
	}

	// Calculate the Haversine distance
	var bestArray = randomStrategy.optimalRoute.chromosome.slice(0);
	var bestTrue = [];

	// Fill the bestTrue array with the true coordinate values,
	// and in the sequence of the most optimal route
	for (var i = 0, l = bestArray.length; i < l; ++i) {
		for (var j = 0, m = bestArray.length; j < m; ++j) {
			if (bestArray[i].name === pathTrue[j].name) {
				var city = new City(0, 0, "");
				city.copyCity(pathTrue[j]);
				bestTrue.push(city);
			}
		}
	}

	noStroke();
	fill(80, 200);
	for (var i = 0, l = numCities - 1; i < l; ++i) {
		sumHaversine += haversine(
			bestTrue[i].lon,
			bestTrue[i + 1].lon,
			bestTrue[i].lat,
			bestTrue[i + 1].lat
		);
	}

	//console.log(numberWithCommas(sumHaversine.toFixed(3)));
	printResults(sumHaversine);

	sumHaversine = 0.0;

	if (generation >= maxGeneration) {
		fill(80, 200);
		noLoop();
	}
}

function parse(data, list1, list2, list3) {
	// console.log(data.length);
	// console.log(data[0].geometry.coordinates[0]);
	// console.log(data[0].geometry.coordinates[1]);
	// console.log(data[0].properties.name);

	for (var i = 0, l = data.length; i < l; ++i) {
		var lon = data[i].geometry.coordinates[0];
		var lat = data[i].geometry.coordinates[1];
		var name = data[i].properties.name;
		list1.push(lon);
		list2.push(lat);
		list3.push(name);
	}
	// console.log(list1);
	// console.log(list2);
	// console.log(list3);
}

function init() {
	for (var i = 0, l = latList.length; i < l; ++i) {
		var cx = webMercatorX(clon);
		var cy = webMercatorY(clat);
		var x = webMercatorX(lonList[i]) - cx;
		var y = webMercatorY(latList[i]) - cy;
		path.push(new City(x, y, nameList[i]));
		pathTrue.push(new City(lonList[i], latList[i], nameList[i]));
	}
	populationList = [];
	for (var i = 0; i < numPop; ++i) {
		populationList.push(new Route(path, true));
	}
	randomStrategy = new RandomStrategy(
		populationList,
		numPop,
		crossoverRate,
		mutationRate,
		generationGap,
		numCities
	);
}

function haversine(lon1, lon2, lat1, lat2) {
	var p = 0.017453292519943295;
	var a =
		0.5 -
		Math.cos((lat2 - lat1) * p) * 0.5 +
		Math.cos(lat1 * p) *
			Math.cos(lat2 * p) *
			(1 - Math.cos((lon2 - lon1) * p)) *
			0.5;
	return 12742 * Math.asin(Math.sqrt(a));
}

function printResults(haversineDistance) {
	var offset = -485;
	var indent = -480;
	var top = 40;

	textStyle(NORMAL);
	haversineDistance = numberWithCommas(haversineDistance.toFixed(3));
	text("Genetic Algorithm Parameters:", offset, top + 20);
	text("*  Generations: " + numberWithCommas(generation), indent, top + 40);
	text(
		"*  Population size: " + numberWithCommas(numPop) + " individuals",
		indent,
		top + 60
	);
	text("*  Crossover rate: " + crossoverRate + "%", indent, top + 80);
	text("*  Mutation rate: " + mutationRate + "%", indent, top + 100);
	text(
		"*  Elitism generation gap: " +
			numberWithCommas(randomStrategy.numElite) +
			" individuals",
		indent,
		top + 120
	);

	textStyle(BOLD);
	text("Convergence at generation: " + converge, offset, top + 160);
	if (generation >= maxGeneration) {
		text(
			"Total distance travelled: " +
				haversineDistance +
				" km [Haversine distance]" +
				" : max. number of iterations reached",
			offset,
			top + 180
		);
	} else {
		text(
			"Total distance travelled: " +
				haversineDistance +
				" km [Haversine distance]",
			offset,
			top + 180
		);
	}
}

function numberWithCommas(value) {
	return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function getWidthOfText(text, fontName, fontSize) {
	if (text === undefined || fontName === undefined || fontSize === undefined) {
		return 0;
	}
	// Create dummy span
	this.e = document.createElement("span");
	// Set font-size
	this.e.style.fontSize = fontSize;
	// Set font-face / font-family
	this.e.style.fontFamily = fontName;
	// Set text
	this.e.innerHTML = text;
	document.body.appendChild(this.e);
	// Get width NOW, since the dummy span is about to be removed from the document
	var textWidth = this.e.offsetWidth;
	// Cleanup
	document.body.removeChild(this.e);
	// All right, we're done
	return textWidth;
}

function webMercatorX(lon) {
	lon = radians(lon);
	var a = (256 / Math.PI) * Math.pow(2, zoom);
	var b = lon + Math.PI;
	return a * b;
}

function webMercatorY(lat) {
	lat = radians(lat);
	var a = (256 / Math.PI) * Math.pow(2, zoom);
	var b = Math.tan(Math.PI * 0.25 + lat * 0.5);
	var c = Math.PI - Math.log(b);
	return a * c;
}
