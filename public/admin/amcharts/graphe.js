var chart;
var chart2;
var legend;

var chartData = [
    {
        "country": "Australie-Méridionale",
        "value": 260
    },
    {
        "country": "Australie-Occidentale",
        "value": 201
    },
    {
        "country": "Nouvelle-Galles du Sud",
        "value": 65
    },
    {
        "country": "Queensland",
        "value": 39
    },
    {
        "country": "Tasmanie",
        "value": 19
    },
    {
        "country": "Victoria",
        "value": 10
    }
];

var chartData2 = [
  {
      "prix": " prix < 300 000 euros",
      "nombre": 700
  },
  {
      "prix": " 300 000 euros > prix <= 500 000 euros",
      "nombre": 600
  },
  {
      "prix": " 500 000 euros > prix <= 750 000 euros",
      "nombre": 400
  },
  {
      "prix": " 750 000 euros > prix <= 1 000 000 euros",
      "nombre": 250
  },
  {
      "prix": " prix > 1 000 000 euros ",
      "nombre": 125
  }
];

var chart3;
var chartData3 = [
  {
    "type": "Maison",
    "nombre": 200,
    "color": "#B0DE09"
  },
  {
    "type": "Appartement",
    "nombre": 500,
    "color": "#B0DE09"
  },
  {
    "type": "Maison de compagne",
    "nombre": 300,
    "color": "#B0DE09"
  },
  {
    "type": "Villa",
    "nombre": 200,
    "color": "#B0DE09"
  },
  {
    "type": "Foncier",
    "nombre": 400,
    "color": "#B0DE09"
  },
  {
    "type": "Commercial",
    "nombre": 380,
    "color": "#B0DE09"
  },
  {
    "type": "Industriel",
    "nombre": 180,
    "color": "#B0DE09"
  },
  {
    "type": "Maison de retraite",
    "nombre": 280,
    "color": "#B0DE09"
  }
];


var chart4;
var chartData4 = [
  {
        "type": "Constructeurs",
      "nombre": 1809,
      "color": "#FF9E01"
  },
  {
      "type": "Promoteurs",
      "nombre": 984,
      "color": "#04D215"
  },
  {
      "type": "AFA",
      "nombre": 665,
      "color": "#0D52D1"
  }
];

var chart5;
var chartData5 = [{
    "country": "USA",
    "visits": 3025,
    "color": "#FF0F00"
  }, {
    "country": "China",
    "visits": 1882,
    "color": "#FF6600"
  }, {
    "country": "Japan",
    "visits": 1809,
    "color": "#FF9E01"
  }, {
    "country": "Germany",
    "visits": 1322,
    "color": "#FCD202"
  }, {
    "country": "UK",
    "visits": 1122,
    "color": "#F8FF01"
  }, {
    "country": "France",
    "visits": 1114,
    "color": "#B0DE09"
  }, {
    "country": "India",
    "visits": 984,
    "color": "#04D215"
  }, {
    "country": "Spain",
    "visits": 711,
    "color": "#0D8ECF"
  }, {
    "country": "Netherlands",
    "visits": 665,
    "color": "#0D52D1"
  }, {
    "country": "Russia",
    "visits": 580,
    "color": "#2A0CD0"
  }, {
    "country": "South Korea",
    "visits": 443,
    "color": "#8A0CCF"
  }, {
    "country": "Canada",
    "visits": 441,
    "color": "#CD0D74"
  }];

  var chart6;
  var chartData6 = [{
        "date": "2012-07-27",
        "value": 13
    }, {
        "date": "2012-07-28",
        "value": 11
    }, {
        "date": "2012-07-29",
        "value": 15
    }, {
        "date": "2012-07-30",
        "value": 16
    }, {
        "date": "2012-07-31",
        "value": 18
    }, {
        "date": "2012-08-01",
        "value": 13
    }, {
        "date": "2012-08-02",
        "value": 22
    }, {
        "date": "2012-08-03",
        "value": 23
    }, {
        "date": "2012-08-04",
        "value": 20
    }, {
        "date": "2012-08-05",
        "value": 17
    }, {
        "date": "2012-08-06",
        "value": 16
    }, {
        "date": "2012-08-07",
        "value": 18
    }, {
        "date": "2012-08-08",
        "value": 21
    }, {
        "date": "2012-08-09",
        "value": 26
    }, {
        "date": "2012-08-10",
        "value": 24
    }, {
        "date": "2012-08-11",
        "value": 29
    }, {
        "date": "2012-08-12",
        "value": 32
    }, {
        "date": "2012-08-13",
        "value": 18
    }, {
        "date": "2012-08-14",
        "value": 24
    }, {
        "date": "2012-08-15",
        "value": 22
    }, {
        "date": "2012-08-16",
        "value": 18
    }, {
        "date": "2012-08-17",
        "value": 19
    }, {
        "date": "2012-08-18",
        "value": 14
    }, {
        "date": "2012-08-19",
        "value": 15
    }, {
        "date": "2012-08-20",
        "value": 12
    }, {
        "date": "2012-08-21",
        "value": 8
    }, {
        "date": "2012-08-22",
        "value": 9
    }, {
        "date": "2012-08-23",
        "value": 8
    }, {
        "date": "2012-08-24",
        "value": 7
    }, {
        "date": "2012-08-25",
        "value": 5
    }, {
        "date": "2012-08-26",
        "value": 11
    }, {
        "date": "2012-08-27",
        "value": 13
    }, {
        "date": "2012-08-28",
        "value": 18
    }, {
        "date": "2012-08-29",
        "value": 20
    }, {
        "date": "2012-08-30",
        "value": 29
    }, {
        "date": "2012-08-31",
        "value": 33
    }, {
        "date": "2012-09-01",
        "value": 42
    }, {
        "date": "2012-09-02",
        "value": 35
    }, {
        "date": "2012-09-03",
        "value": 31
    }, {
        "date": "2012-09-04",
        "value": 47
    }, {
        "date": "2012-09-05",
        "value": 52
    }, {
        "date": "2012-09-06",
        "value": 46
    }, {
        "date": "2012-09-07",
        "value": 41
    }, {
        "date": "2012-09-08",
        "value": 43
    }, {
        "date": "2012-09-09",
        "value": 40
    }, {
        "date": "2012-09-10",
        "value": 39
    }, {
        "date": "2012-09-11",
        "value": 34
    }, {
        "date": "2012-09-12",
        "value": 29
    }, {
        "date": "2012-09-13",
        "value": 34
    }, {
        "date": "2012-09-14",
        "value": 37
    }, {
        "date": "2012-09-15",
        "value": 42
    }, {
        "date": "2012-09-16",
        "value": 49
    }, {
        "date": "2012-09-17",
        "value": 46
    }, {
        "date": "2012-09-18",
        "value": 47
    }, {
        "date": "2012-09-19",
        "value": 55
    }, {
        "date": "2012-09-20",
        "value": 59
    }, {
        "date": "2012-09-21",
        "value": 58
    }, {
        "date": "2012-09-22",
        "value": 57
    }, {
        "date": "2012-09-23",
        "value": 61
    }, {
        "date": "2012-09-24",
        "value": 59
    }, {
        "date": "2012-09-25",
        "value": 67
    }, {
        "date": "2012-09-26",
        "value": 65
    }, {
        "date": "2012-09-27",
        "value": 61
    }, {
        "date": "2012-09-28",
        "value": 66
    }, {
        "date": "2012-09-29",
        "value": 69
    }, {
        "date": "2012-09-30",
        "value": 71
    }, {
        "date": "2012-10-01",
        "value": 67
    }, {
        "date": "2012-10-02",
        "value": 63
    }, {
        "date": "2012-10-03",
        "value": 46
    }, {
        "date": "2012-10-04",
        "value": 32
    }, {
        "date": "2012-10-05",
        "value": 21
    }, {
        "date": "2012-10-06",
        "value": 18
    }, {
        "date": "2012-10-07",
        "value": 21
    }, {
        "date": "2012-10-08",
        "value": 28
    }, {
        "date": "2012-10-09",
        "value": 27
    }, {
        "date": "2012-10-10",
        "value": 36
    }, {
        "date": "2012-10-11",
        "value": 33
    }, {
        "date": "2012-10-12",
        "value": 31
    }, {
        "date": "2012-10-13",
        "value": 30
    }, {
        "date": "2012-10-14",
        "value": 34
    }, {
        "date": "2012-10-15",
        "value": 38
    }, {
        "date": "2012-10-16",
        "value": 37
    }, {
        "date": "2012-10-17",
        "value": 44
    }, {
        "date": "2012-10-18",
        "value": 49
    }, {
        "date": "2012-10-19",
        "value": 53
    }, {
        "date": "2012-10-20",
        "value": 57
    }, {
        "date": "2012-10-21",
        "value": 60
    }, {
        "date": "2012-10-22",
        "value": 61
    }, {
        "date": "2012-10-23",
        "value": 69
    }, {
        "date": "2012-10-24",
        "value": 67
    }, {
        "date": "2012-10-25",
        "value": 72
    }, {
        "date": "2012-10-26",
        "value": 77
    }, {
        "date": "2012-10-27",
        "value": 75
    }, {
        "date": "2012-10-28",
        "value": 70
    }, {
        "date": "2012-10-29",
        "value": 72
    }, {
        "date": "2012-10-30",
        "value": 70
    }, {
        "date": "2012-10-31",
        "value": 72
    }, {
        "date": "2012-11-01",
        "value": 73
    }, {
        "date": "2012-11-02",
        "value": 67
    }, {
        "date": "2012-11-03",
        "value": 68
    }, {
        "date": "2012-11-04",
        "value": 65
    }, {
        "date": "2012-11-05",
        "value": 71
    }, {
        "date": "2012-11-06",
        "value": 75
    }, {
        "date": "2012-11-07",
        "value": 74
    }, {
        "date": "2012-11-08",
        "value": 71
    }, {
        "date": "2012-11-09",
        "value": 76
    }, {
        "date": "2012-11-10",
        "value": 77
    }, {
        "date": "2012-11-11",
        "value": 81
    }, {
        "date": "2012-11-12",
        "value": 83
    }, {
        "date": "2012-11-13",
        "value": 80
    }, {
        "date": "2012-11-14",
        "value": 81
    }, {
        "date": "2012-11-15",
        "value": 87
    }, {
        "date": "2012-11-16",
        "value": 82
    }, {
        "date": "2012-11-17",
        "value": 86
    }, {
        "date": "2012-11-18",
        "value": 80
    }, {
        "date": "2012-11-19",
        "value": 87
    }, {
        "date": "2012-11-20",
        "value": 83
    }, {
        "date": "2012-11-21",
        "value": 85
    }, {
        "date": "2012-11-22",
        "value": 84
    }, {
        "date": "2012-11-23",
        "value": 82
    }, {
        "date": "2012-11-24",
        "value": 73
    }, {
        "date": "2012-11-25",
        "value": 71
    }, {
        "date": "2012-11-26",
        "value": 75
    }, {
        "date": "2012-11-27",
        "value": 79
    }, {
        "date": "2012-11-28",
        "value": 70
    }, {
        "date": "2012-11-29",
        "value": 73
    }, {
        "date": "2012-11-30",
        "value": 61
    }, {
        "date": "2012-12-01",
        "value": 62
    }, {
        "date": "2012-12-02",
        "value": 66
    }, {
        "date": "2012-12-03",
        "value": 65
    }, {
        "date": "2012-12-04",
        "value": 73
    }, {
        "date": "2012-12-05",
        "value": 79
    }, {
        "date": "2012-12-06",
        "value": 78
    }, {
        "date": "2012-12-07",
        "value": 78
    }, {
        "date": "2012-12-08",
        "value": 78
    }, {
        "date": "2012-12-09",
        "value": 74
    }, {
        "date": "2012-12-10",
        "value": 73
    }, {
        "date": "2012-12-11",
        "value": 75
    }, {
        "date": "2012-12-12",
        "value": 70
    }, {
        "date": "2012-12-13",
        "value": 77
    }, {
        "date": "2012-12-14",
        "value": 67
    }, {
        "date": "2012-12-15",
        "value": 62
    }, {
        "date": "2012-12-16",
        "value": 64
    }, {
        "date": "2012-12-17",
        "value": 61
    }, {
        "date": "2012-12-18",
        "value": 59
    }, {
        "date": "2012-12-19",
        "value": 53
    }, {
        "date": "2012-12-20",
        "value": 54
    }, {
        "date": "2012-12-21",
        "value": 56
    }, {
        "date": "2012-12-22",
        "value": 59
    }, {
        "date": "2012-12-23",
        "value": 58
    }, {
        "date": "2012-12-24",
        "value": 55
    }, {
        "date": "2012-12-25",
        "value": 52
    }, {
        "date": "2012-12-26",
        "value": 54
    }, {
        "date": "2012-12-27",
        "value": 50
    }, {
        "date": "2012-12-28",
        "value": 50
    }, {
        "date": "2012-12-29",
        "value": 51
    }, {
        "date": "2012-12-30",
        "value": 52
    }, {
        "date": "2012-12-31",
        "value": 58
    }, {
        "date": "2013-01-01",
        "value": 60
    }, {
        "date": "2013-01-02",
        "value": 67
    }, {
        "date": "2013-01-03",
        "value": 64
    }, {
        "date": "2013-01-04",
        "value": 66
    }, {
        "date": "2013-01-05",
        "value": 60
    }, {
        "date": "2013-01-06",
        "value": 63
    }, {
        "date": "2013-01-07",
        "value": 61
    }, {
        "date": "2013-01-08",
        "value": 60
    }, {
        "date": "2013-01-09",
        "value": 65
    }, {
        "date": "2013-01-10",
        "value": 75
    }, {
        "date": "2013-01-11",
        "value": 77
    }, {
        "date": "2013-01-12",
        "value": 78
    }, {
        "date": "2013-01-13",
        "value": 70
    }, {
        "date": "2013-01-14",
        "value": 70
    }, {
        "date": "2013-01-15",
        "value": 73
    }, {
        "date": "2013-01-16",
        "value": 71
    }, {
        "date": "2013-01-17",
        "value": 74
    }, {
        "date": "2013-01-18",
        "value": 78
    }, {
        "date": "2013-01-19",
        "value": 85
    }, {
        "date": "2013-01-20",
        "value": 82
    }, {
        "date": "2013-01-21",
        "value": 83
    }, {
        "date": "2013-01-22",
        "value": 88
    }, {
        "date": "2013-01-23",
        "value": 85
    }, {
        "date": "2013-01-24",
        "value": 85
    }, {
        "date": "2013-01-25",
        "value": 80
    }, {
        "date": "2013-01-26",
        "value": 87
    }, {
        "date": "2013-01-27",
        "value": 84
    }, {
        "date": "2013-01-28",
        "value": 83
    }, {
        "date": "2013-01-29",
        "value": 84
    }, {
        "date": "2013-01-30",
        "value": 81
    }];

var chart7;
var chartData7 = [{
    "country": "USA",
    "visits": 1523,
    "color": "#FF0F00"
  }, {
    "country": "China",
    "visits": 2250,
    "color": "#FF6600"
  }, {
    "country": "Japan",
    "visits": 1809,
    "color": "#FF9E01"
  }, {
    "country": "Germany",
    "visits": 1322,
    "color": "#FCD202"
  }, {
    "country": "UK",
    "visits": 1478,
    "color": "#F8FF01"
  }, {
    "country": "France",
    "visits": 1114,
    "color": "#B0DE09"
  }, {
    "country": "India",
    "visits": 984,
    "color": "#04D215"
  }, {
    "country": "Spain",
    "visits": 711,
    "color": "#0D8ECF"
  }, {
    "country": "Netherlands",
    "visits": 665,
    "color": "#0D52D1"
  }, {
    "country": "Russia",
    "visits": 3000,
    "color": "#2A0CD0"
  }, {
    "country": "South Korea",
    "visits": 443,
    "color": "#8A0CCF"
  }, {
    "country": "Canada",
    "visits": 441,
    "color": "#CD0D74"
  }];

var chart8;
var chartData8 =  [{
      "date": "2012-07-27",
      "value": 25
  }, {
      "date": "2012-07-28",
      "value": 16
  }, {
      "date": "2012-07-29",
      "value": 17
  }, {
      "date": "2012-07-30",
      "value": 19
  }, {
      "date": "2012-07-31",
      "value": 18
  }, {
      "date": "2012-08-01",
      "value": 10
  }, {
      "date": "2012-08-02",
      "value": 25
  }, {
      "date": "2012-08-03",
      "value": 20
  }, {
      "date": "2012-08-04",
      "value": 14
  }, {
      "date": "2012-08-05",
      "value": 16
  }, {
      "date": "2012-08-06",
      "value": 23
  }, {
      "date": "2012-08-07",
      "value": 36
  }, {
      "date": "2012-08-08",
      "value": 21
  }, {
      "date": "2012-08-09",
      "value": 26
  }, {
      "date": "2012-08-10",
      "value": 24
  }, {
      "date": "2012-08-11",
      "value": 29
  }, {
      "date": "2012-08-12",
      "value": 32
  }, {
      "date": "2012-08-13",
      "value": 18
  }, {
      "date": "2012-08-14",
      "value": 24
  }, {
      "date": "2012-08-15",
      "value": 22
  }, {
      "date": "2012-08-16",
      "value": 18
  }, {
      "date": "2012-08-17",
      "value": 25
  }, {
      "date": "2012-08-18",
      "value": 30
  }, {
      "date": "2012-08-19",
      "value": 14
  }, {
      "date": "2012-08-20",
      "value": 10
  }, {
      "date": "2012-08-21",
      "value": 8
  }, {
      "date": "2012-08-22",
      "value": 9
  }, {
      "date": "2012-08-23",
      "value": 8
  }, {
      "date": "2012-08-24",
      "value": 7
  }, {
      "date": "2012-08-25",
      "value": 5
  }, {
      "date": "2012-08-26",
      "value": 11
  }, {
      "date": "2012-08-27",
      "value": 13
  }, {
      "date": "2012-08-28",
      "value": 18
  }, {
      "date": "2012-08-29",
      "value": 20
  }, {
      "date": "2012-08-30",
      "value": 29
  }, {
      "date": "2012-08-31",
      "value": 33
  }, {
      "date": "2012-09-01",
      "value": 42
  }, {
      "date": "2012-09-02",
      "value": 35
  }, {
      "date": "2012-09-03",
      "value": 31
  }, {
      "date": "2012-09-04",
      "value": 47
  }, {
      "date": "2012-09-05",
      "value": 52
  }, {
      "date": "2012-09-06",
      "value": 46
  }, {
      "date": "2012-09-07",
      "value": 41
  }, {
      "date": "2012-09-08",
      "value": 43
  }, {
      "date": "2012-09-09",
      "value": 40
  }, {
      "date": "2012-09-10",
      "value": 39
  }, {
      "date": "2012-09-11",
      "value": 34
  }, {
      "date": "2012-09-12",
      "value": 29
  }, {
      "date": "2012-09-13",
      "value": 34
  }, {
      "date": "2012-09-14",
      "value": 37
  }, {
      "date": "2012-09-15",
      "value": 42
  }, {
      "date": "2012-09-16",
      "value": 49
  }, {
      "date": "2012-09-17",
      "value": 46
  }, {
      "date": "2012-09-18",
      "value": 47
  }, {
      "date": "2012-09-19",
      "value": 25
  }, {
      "date": "2012-09-20",
      "value": 30
  }, {
      "date": "2012-09-21",
      "value": 21
  }, {
      "date": "2012-09-22",
      "value": 18
  }, {
      "date": "2012-09-23",
      "value": 10
  }, {
      "date": "2012-09-24",
      "value": 11
  }, {
      "date": "2012-09-25",
      "value": 19
  }, {
      "date": "2012-09-26",
      "value": 26
  }, {
      "date": "2012-09-27",
      "value": 35
  }, {
      "date": "2012-09-28",
      "value": 40
  }, {
      "date": "2012-09-29",
      "value": 49
  }, {
      "date": "2012-09-30",
      "value": 52
  }, {
      "date": "2012-10-01",
      "value": 55
  }, {
      "date": "2012-10-02",
      "value": 63
  }, {
      "date": "2012-10-03",
      "value": 46
  }, {
      "date": "2012-10-04",
      "value": 32
  }, {
      "date": "2012-10-05",
      "value": 21
  }, {
      "date": "2012-10-06",
      "value": 18
  }, {
      "date": "2012-10-07",
      "value": 21
  }, {
      "date": "2012-10-08",
      "value": 28
  }, {
      "date": "2012-10-09",
      "value": 27
  }, {
      "date": "2012-10-10",
      "value": 36
  }, {
      "date": "2012-10-11",
      "value": 33
  }, {
      "date": "2012-10-12",
      "value": 31
  }, {
      "date": "2012-10-13",
      "value": 30
  }, {
      "date": "2012-10-14",
      "value": 34
  }, {
      "date": "2012-10-15",
      "value": 38
  }, {
      "date": "2012-10-16",
      "value": 37
  }, {
      "date": "2012-10-17",
      "value": 44
  }, {
      "date": "2012-10-18",
      "value": 49
  }, {
      "date": "2012-10-19",
      "value": 53
  }, {
      "date": "2012-10-20",
      "value": 57
  }, {
      "date": "2012-10-21",
      "value": 60
  }, {
      "date": "2012-10-22",
      "value": 61
  }, {
      "date": "2012-10-23",
      "value": 69
  }, {
      "date": "2012-10-24",
      "value": 67
  }, {
      "date": "2012-10-25",
      "value": 72
  }, {
      "date": "2012-10-26",
      "value": 77
  }, {
      "date": "2012-10-27",
      "value": 75
  }, {
      "date": "2012-10-28",
      "value": 70
  }, {
      "date": "2012-10-29",
      "value": 72
  }, {
      "date": "2012-10-30",
      "value": 70
  }, {
      "date": "2012-10-31",
      "value": 72
  }, {
      "date": "2012-11-01",
      "value": 73
  }, {
      "date": "2012-11-02",
      "value": 67
  }, {
      "date": "2012-11-03",
      "value": 68
  }, {
      "date": "2012-11-04",
      "value": 65
  }, {
      "date": "2012-11-05",
      "value": 71
  }, {
      "date": "2012-11-06",
      "value": 75
  }, {
      "date": "2012-11-07",
      "value": 74
  }, {
      "date": "2012-11-08",
      "value": 71
  }, {
      "date": "2012-11-09",
      "value": 76
  }, {
      "date": "2012-11-10",
      "value": 77
  }, {
      "date": "2012-11-11",
      "value": 81
  }, {
      "date": "2012-11-12",
      "value": 83
  }, {
      "date": "2012-11-13",
      "value": 80
  }, {
      "date": "2012-11-14",
      "value": 81
  }, {
      "date": "2012-11-15",
      "value": 87
  }, {
      "date": "2012-11-16",
      "value": 82
  }, {
      "date": "2012-11-17",
      "value": 86
  }, {
      "date": "2012-11-18",
      "value": 80
  }, {
      "date": "2012-11-19",
      "value": 87
  }, {
      "date": "2012-11-20",
      "value": 83
  }, {
      "date": "2012-11-21",
      "value": 85
  }, {
      "date": "2012-11-22",
      "value": 84
  }, {
      "date": "2012-11-23",
      "value": 82
  }, {
      "date": "2012-11-24",
      "value": 73
  }, {
      "date": "2012-11-25",
      "value": 71
  }, {
      "date": "2012-11-26",
      "value": 75
  }, {
      "date": "2012-11-27",
      "value": 79
  }, {
      "date": "2012-11-28",
      "value": 70
  }, {
      "date": "2012-11-29",
      "value": 73
  }, {
      "date": "2012-11-30",
      "value": 61
  }, {
      "date": "2012-12-01",
      "value": 62
  }, {
      "date": "2012-12-02",
      "value": 66
  }, {
      "date": "2012-12-03",
      "value": 65
  }, {
      "date": "2012-12-04",
      "value": 73
  }, {
      "date": "2012-12-05",
      "value": 79
  }, {
      "date": "2012-12-06",
      "value": 78
  }, {
      "date": "2012-12-07",
      "value": 78
  }, {
      "date": "2012-12-08",
      "value": 78
  }, {
      "date": "2012-12-09",
      "value": 74
  }, {
      "date": "2012-12-10",
      "value": 73
  }, {
      "date": "2012-12-11",
      "value": 75
  }, {
      "date": "2012-12-12",
      "value": 70
  }, {
      "date": "2012-12-13",
      "value": 77
  }, {
      "date": "2012-12-14",
      "value": 67
  }, {
      "date": "2012-12-15",
      "value": 62
  }, {
      "date": "2012-12-16",
      "value": 64
  }, {
      "date": "2012-12-17",
      "value": 61
  }, {
      "date": "2012-12-18",
      "value": 59
  }, {
      "date": "2012-12-19",
      "value": 53
  }, {
      "date": "2012-12-20",
      "value": 54
  }, {
      "date": "2012-12-21",
      "value": 56
  }, {
      "date": "2012-12-22",
      "value": 59
  }, {
      "date": "2012-12-23",
      "value": 58
  }, {
      "date": "2012-12-24",
      "value": 55
  }, {
      "date": "2012-12-25",
      "value": 52
  }, {
      "date": "2012-12-26",
      "value": 54
  }, {
      "date": "2012-12-27",
      "value": 50
  }, {
      "date": "2012-12-28",
      "value": 50
  }, {
      "date": "2012-12-29",
      "value": 51
  }, {
      "date": "2012-12-30",
      "value": 52
  }, {
      "date": "2012-12-31",
      "value": 58
  }, {
      "date": "2013-01-01",
      "value": 60
  }, {
      "date": "2013-01-02",
      "value": 67
  }, {
      "date": "2013-01-03",
      "value": 64
  }, {
      "date": "2013-01-04",
      "value": 66
  }, {
      "date": "2013-01-05",
      "value": 60
  }, {
      "date": "2013-01-06",
      "value": 63
  }, {
      "date": "2013-01-07",
      "value": 30
  }, {
      "date": "2013-01-08",
      "value": 45
  }, {
      "date": "2013-01-09",
      "value": 26
  }, {
      "date": "2013-01-10",
      "value": 22
  }, {
      "date": "2013-01-11",
      "value": 18
  }, {
      "date": "2013-01-12",
      "value": 35
  }, {
      "date": "2013-01-13",
      "value": 40
  }, {
      "date": "2013-01-14",
      "value": 49
  }, {
      "date": "2013-01-15",
      "value": 55
  }, {
      "date": "2013-01-16",
      "value": 60
  }, {
      "date": "2013-01-17",
      "value": 75
  }, {
      "date": "2013-01-18",
      "value": 78
  }, {
      "date": "2013-01-19",
      "value": 68
  }, {
      "date": "2013-01-20",
      "value": 66
  }, {
      "date": "2013-01-21",
      "value": 20
  }, {
      "date": "2013-01-22",
      "value": 15
  }, {
      "date": "2013-01-23",
      "value": 07
  }, {
      "date": "2013-01-24",
      "value": 60
  }, {
      "date": "2013-01-25",
      "value": 80
  }, {
      "date": "2013-01-26",
      "value": 87
  }, {
      "date": "2013-01-27",
      "value": 84
  }, {
      "date": "2013-01-28",
      "value": 35
  }, {
      "date": "2013-01-29",
      "value": 44
  }, {
      "date": "2013-01-30",
      "value": 81
  }];

var chart9;
var chartData9 = [
  {
    "type": "Maison",
    "nombre": 100,
    "color": "#FF6600"
  },
  {
    "type": "Appartement",
    "nombre": 350,
    "color": "#FF6600"
  },
  {
    "type": "Maison de compagne",
    "nombre": 200,
    "color": "#FF6600"
  },
  {
    "type": "Villa",
    "nombre": 255,
    "color": "#FF6600"
  },
  {
    "type": "Foncier",
    "nombre": 245,
    "color": "#FF6600"
  },
  {
    "type": "Commercial",
    "nombre": 145,
    "color": "#FF6600"
  },
  {
    "type": "Industriel",
    "nombre": 245,
    "color": "#FF6600"
  },
  {
    "type": "Maison de retraite",
    "nombre": 290,
    "color": "#FF6600"
  }
];

var chart10;
var chartData10 = [{
    "country": "Australie-Méridionale",
    "litres": 501.9
  }, {
    "country": "Australie-Occidentale",
    "litres": 301.9
  }, {
    "country": "Nouvelle-Galles du Sud",
    "litres": 201.1
  }, {
    "country": "Queensland",
    "litres": 165.8
  }, {
    "country": "Tasmanie",
    "litres": 139.9
  }, {
    "country": "Victoria",
    "litres": 128.3
  }];

var chart11;
var chartData11 = [ {
    "title": " prix < 100 000 euros ",
    "value": 300
  }, {
    "title": " 100 000 euros <= prix < 300 000 euros ",
    "value": 123
  }, {
    "title": " 300 000 euros <= prix < 500 000 euros ",
    "value": 98
  }, {
    "title": " 500 000 euros <= prix < 750 000 euros ",
    "value": 72
  }, {
    "title": " 750 000 euros <= prix < 1 000 000 euros",
    "value": 35
  }, {
    "title": " 1 000 000 euros > prix ",
    "value": 25
  }];

  var chart12;
  var chartData12 =  [{
    "etat": "Australie-Méridionale",
    "nombre": 25,
    "color": "#0D8ECF"
  },{
    "etat": "Australie-Occidentale",
    "nombre": 16,
    "color": "#0D8ECF"
  },{
    "etat": "Nouvelle-Galles du Sud",
    "nombre": 40,
    "color": "#0D8ECF"
  },{
    "etat": "Queensland",
    "nombre": 11,
    "color": "#0D8ECF"
  },{
    "etat": "Tasmanie",
    "nombre": 19,
    "color": "#0D8ECF"
  },{
    "etat": "Victoria",
    "nombre": 18,
    "color": "#0D8ECF"
  }];

  var chart13;
  var chartData13 = [{
        "date": "2012-07-27",
        "value": 13
    }, {
        "date": "2012-07-28",
        "value": 11
    }, {
        "date": "2012-07-29",
        "value": 15
    }, {
        "date": "2012-07-30",
        "value": 16
    }, {
        "date": "2012-07-31",
        "value": 18
    }, {
        "date": "2012-08-01",
        "value": 13
    }, {
        "date": "2012-08-02",
        "value": 22
    }, {
        "date": "2012-08-03",
        "value": 23
    }, {
        "date": "2012-08-04",
        "value": 20
    }, {
        "date": "2012-08-05",
        "value": 17
    }, {
        "date": "2012-08-06",
        "value": 16
    }, {
        "date": "2012-08-07",
        "value": 18
    }, {
        "date": "2012-08-08",
        "value": 21
    }, {
        "date": "2012-08-09",
        "value": 26
    }, {
        "date": "2012-08-10",
        "value": 24
    }, {
        "date": "2012-08-11",
        "value": 29
    }, {
        "date": "2012-08-12",
        "value": 32
    }, {
        "date": "2012-08-13",
        "value": 18
    }, {
        "date": "2012-08-14",
        "value": 24
    }, {
        "date": "2012-08-15",
        "value": 22
    }, {
        "date": "2012-08-16",
        "value": 18
    }, {
        "date": "2012-08-17",
        "value": 19
    }, {
        "date": "2012-08-18",
        "value": 14
    }, {
        "date": "2012-08-19",
        "value": 15
    }, {
        "date": "2012-08-20",
        "value": 12
    }, {
        "date": "2012-08-21",
        "value": 8
    }, {
        "date": "2012-08-22",
        "value": 9
    }, {
        "date": "2012-08-23",
        "value": 8
    }, {
        "date": "2012-08-24",
        "value": 7
    }, {
        "date": "2012-08-25",
        "value": 5
    }, {
        "date": "2012-08-26",
        "value": 11
    }, {
        "date": "2012-08-27",
        "value": 13
    }, {
        "date": "2012-08-28",
        "value": 18
    }, {
        "date": "2012-08-29",
        "value": 20
    }, {
        "date": "2012-08-30",
        "value": 29
    }, {
        "date": "2012-08-31",
        "value": 33
    }, {
        "date": "2012-09-01",
        "value": 42
    }, {
        "date": "2012-09-02",
        "value": 35
    }, {
        "date": "2012-09-03",
        "value": 31
    }, {
        "date": "2012-09-04",
        "value": 47
    }, {
        "date": "2012-09-05",
        "value": 52
    }, {
        "date": "2012-09-06",
        "value": 46
    }, {
        "date": "2012-09-07",
        "value": 41
    }, {
        "date": "2012-09-08",
        "value": 43
    }, {
        "date": "2012-09-09",
        "value": 40
    }, {
        "date": "2012-09-10",
        "value": 39
    }, {
        "date": "2012-09-11",
        "value": 34
    }, {
        "date": "2012-09-12",
        "value": 29
    }, {
        "date": "2012-09-13",
        "value": 34
    }, {
        "date": "2012-09-14",
        "value": 37
    }, {
        "date": "2012-09-15",
        "value": 42
    }, {
        "date": "2012-09-16",
        "value": 49
    }, {
        "date": "2012-09-17",
        "value": 46
    }, {
        "date": "2012-09-18",
        "value": 47
    }, {
        "date": "2012-09-19",
        "value": 55
    }, {
        "date": "2012-09-20",
        "value": 59
    }, {
        "date": "2012-09-21",
        "value": 58
    }, {
        "date": "2012-09-22",
        "value": 57
    }, {
        "date": "2012-09-23",
        "value": 61
    }, {
        "date": "2012-09-24",
        "value": 59
    }, {
        "date": "2012-09-25",
        "value": 67
    }, {
        "date": "2012-09-26",
        "value": 65
    }, {
        "date": "2012-09-27",
        "value": 61
    }, {
        "date": "2012-09-28",
        "value": 66
    }, {
        "date": "2012-09-29",
        "value": 69
    }, {
        "date": "2012-09-30",
        "value": 71
    }, {
        "date": "2012-10-01",
        "value": 67
    }, {
        "date": "2012-10-02",
        "value": 63
    }, {
        "date": "2012-10-03",
        "value": 46
    }, {
        "date": "2012-10-04",
        "value": 32
    }, {
        "date": "2012-10-05",
        "value": 21
    }, {
        "date": "2012-10-06",
        "value": 18
    }, {
        "date": "2012-10-07",
        "value": 21
    }, {
        "date": "2012-10-08",
        "value": 28
    }, {
        "date": "2012-10-09",
        "value": 27
    }, {
        "date": "2012-10-10",
        "value": 36
    }, {
        "date": "2012-10-11",
        "value": 33
    }, {
        "date": "2012-10-12",
        "value": 31
    }, {
        "date": "2012-10-13",
        "value": 30
    }, {
        "date": "2012-10-14",
        "value": 34
    }, {
        "date": "2012-10-15",
        "value": 38
    }, {
        "date": "2012-10-16",
        "value": 37
    }, {
        "date": "2012-10-17",
        "value": 44
    }, {
        "date": "2012-10-18",
        "value": 49
    }, {
        "date": "2012-10-19",
        "value": 53
    }, {
        "date": "2012-10-20",
        "value": 57
    }, {
        "date": "2012-10-21",
        "value": 60
    }, {
        "date": "2012-10-22",
        "value": 61
    }, {
        "date": "2012-10-23",
        "value": 69
    }, {
        "date": "2012-10-24",
        "value": 67
    }, {
        "date": "2012-10-25",
        "value": 72
    }, {
        "date": "2012-10-26",
        "value": 77
    }, {
        "date": "2012-10-27",
        "value": 75
    }, {
        "date": "2012-10-28",
        "value": 70
    }, {
        "date": "2012-10-29",
        "value": 72
    }, {
        "date": "2012-10-30",
        "value": 70
    }, {
        "date": "2012-10-31",
        "value": 72
    }, {
        "date": "2012-11-01",
        "value": 73
    }, {
        "date": "2012-11-02",
        "value": 67
    }, {
        "date": "2012-11-03",
        "value": 68
    }, {
        "date": "2012-11-04",
        "value": 65
    }, {
        "date": "2012-11-05",
        "value": 71
    }, {
        "date": "2012-11-06",
        "value": 75
    }, {
        "date": "2012-11-07",
        "value": 74
    }, {
        "date": "2012-11-08",
        "value": 71
    }, {
        "date": "2012-11-09",
        "value": 76
    }, {
        "date": "2012-11-10",
        "value": 77
    }, {
        "date": "2012-11-11",
        "value": 81
    }, {
        "date": "2012-11-12",
        "value": 83
    }, {
        "date": "2012-11-13",
        "value": 80
    }, {
        "date": "2012-11-14",
        "value": 81
    }, {
        "date": "2012-11-15",
        "value": 87
    }, {
        "date": "2012-11-16",
        "value": 82
    }, {
        "date": "2012-11-17",
        "value": 86
    }, {
        "date": "2012-11-18",
        "value": 80
    }, {
        "date": "2012-11-19",
        "value": 87
    }, {
        "date": "2012-11-20",
        "value": 83
    }, {
        "date": "2012-11-21",
        "value": 85
    }, {
        "date": "2012-11-22",
        "value": 84
    }, {
        "date": "2012-11-23",
        "value": 82
    }, {
        "date": "2012-11-24",
        "value": 73
    }, {
        "date": "2012-11-25",
        "value": 71
    }, {
        "date": "2012-11-26",
        "value": 75
    }, {
        "date": "2012-11-27",
        "value": 79
    }, {
        "date": "2012-11-28",
        "value": 70
    }, {
        "date": "2012-11-29",
        "value": 73
    }, {
        "date": "2012-11-30",
        "value": 61
    }, {
        "date": "2012-12-01",
        "value": 62
    }, {
        "date": "2012-12-02",
        "value": 66
    }, {
        "date": "2012-12-03",
        "value": 65
    }, {
        "date": "2012-12-04",
        "value": 73
    }, {
        "date": "2012-12-05",
        "value": 79
    }, {
        "date": "2012-12-06",
        "value": 78
    }, {
        "date": "2012-12-07",
        "value": 78
    }, {
        "date": "2012-12-08",
        "value": 78
    }, {
        "date": "2012-12-09",
        "value": 74
    }, {
        "date": "2012-12-10",
        "value": 73
    }, {
        "date": "2012-12-11",
        "value": 75
    }, {
        "date": "2012-12-12",
        "value": 70
    }, {
        "date": "2012-12-13",
        "value": 77
    }, {
        "date": "2012-12-14",
        "value": 67
    }, {
        "date": "2012-12-15",
        "value": 62
    }, {
        "date": "2012-12-16",
        "value": 64
    }, {
        "date": "2012-12-17",
        "value": 61
    }, {
        "date": "2012-12-18",
        "value": 59
    }, {
        "date": "2012-12-19",
        "value": 53
    }, {
        "date": "2012-12-20",
        "value": 54
    }, {
        "date": "2012-12-21",
        "value": 56
    }, {
        "date": "2012-12-22",
        "value": 59
    }, {
        "date": "2012-12-23",
        "value": 58
    }, {
        "date": "2012-12-24",
        "value": 55
    }, {
        "date": "2012-12-25",
        "value": 52
    }, {
        "date": "2012-12-26",
        "value": 54
    }, {
        "date": "2012-12-27",
        "value": 50
    }, {
        "date": "2012-12-28",
        "value": 50
    }, {
        "date": "2012-12-29",
        "value": 51
    }, {
        "date": "2012-12-30",
        "value": 52
    }, {
        "date": "2012-12-31",
        "value": 58
    }, {
        "date": "2013-01-01",
        "value": 60
    }, {
        "date": "2013-01-02",
        "value": 67
    }, {
        "date": "2013-01-03",
        "value": 64
    }, {
        "date": "2013-01-04",
        "value": 66
    }, {
        "date": "2013-01-05",
        "value": 60
    }, {
        "date": "2013-01-06",
        "value": 63
    }, {
        "date": "2013-01-07",
        "value": 61
    }, {
        "date": "2013-01-08",
        "value": 60
    }, {
        "date": "2013-01-09",
        "value": 65
    }, {
        "date": "2013-01-10",
        "value": 75
    }, {
        "date": "2013-01-11",
        "value": 77
    }, {
        "date": "2013-01-12",
        "value": 78
    }, {
        "date": "2013-01-13",
        "value": 70
    }, {
        "date": "2013-01-14",
        "value": 70
    }, {
        "date": "2013-01-15",
        "value": 73
    }, {
        "date": "2013-01-16",
        "value": 71
    }, {
        "date": "2013-01-17",
        "value": 74
    }, {
        "date": "2013-01-18",
        "value": 78
    }, {
        "date": "2013-01-19",
        "value": 85
    }, {
        "date": "2013-01-20",
        "value": 82
    }, {
        "date": "2013-01-21",
        "value": 83
    }, {
        "date": "2013-01-22",
        "value": 88
    }, {
        "date": "2013-01-23",
        "value": 85
    }, {
        "date": "2013-01-24",
        "value": 85
    }, {
        "date": "2013-01-25",
        "value": 80
    }, {
        "date": "2013-01-26",
        "value": 87
    }, {
        "date": "2013-01-27",
        "value": 84
    }, {
        "date": "2013-01-28",
        "value": 83
    }, {
        "date": "2013-01-29",
        "value": 84
    }, {
        "date": "2013-01-30",
        "value": 81
    }];

  var chart14;
  var chartData14 = [ {
    "prix": " prix < 100 000 euros",
    "valeur": 501.9
  }, {
    "prix": " 100 000 euros <= prix < 300 000 euros",
    "valeur": 301.9
  }, {
    "prix": " 300 000 euros <= prix < 500 000 euros",
    "valeur": 201.1
  }, {
    "prix": " 500 000 euros <= prix < 750 000 euros",
    "valeur": 165.8
  }, {
    "prix": " 750 000 euros <= prix < 1 000 000 euros",
    "valeur": 139.9
  }, {
    "prix": " prix > 1 000 000 euros",
    "valeur": 128.3
  }];

  var chart15;
  var chartData15 = [ {
    "country": "USA",
    "visits": 2025
  }, {
    "country": "China",
    "visits": 1882
  }, {
    "country": "Japan",
    "visits": 1809
  }, {
    "country": "Germany",
    "visits": 1322
  }, {
    "country": "UK",
    "visits": 1122
  }, {
    "country": "France",
    "visits": 1114
  }, {
    "country": "India",
    "visits": 984
  }, {
    "country": "Spain",
    "visits": 711
  }, {
    "country": "Netherlands",
    "visits": 665
  }, {
    "country": "Russia",
    "visits": 580
  }, {
    "country": "South Korea",
    "visits": 443
  }, {
    "country": "Canada",
    "visits": 441
  }, {
    "country": "Brazil",
    "visits": 395
  } ];

  var chart16;
  var chart17;
  var chartData17 = [
      {
          "country": "APL France",
          "value": 110
      },
      {
          "country": "APL USA",
          "value": 10
      },
      {
          "country": "APL Japan",
          "value": 210
      },
      {
          "country": "APL UK",
          "value": 39
      },
      {
          "country": "APL Spain",
          "value": 19
      },
      {
          "country": "APL Canada",
          "value": 60
      }
  ];

  var chart18;
  var chartData18 = [
      {
          "country": "APL France",
          "value": 80
      },
      {
          "country": "APL USA",
          "value": 90
      },
      {
          "country": "APL India",
          "value": 155
      },
      {
          "country": "APL Canada",
          "value": 100
      },
      {
          "country": "APL Germany",
          "value": 19
      },
      {
          "country": "APL South Korea",
          "value": 240
      }
  ];

  var chartData19 = [{
        "date": "2012-07-27",
        "nombre": 50
    }, {
        "date": "2012-07-28",
        "nombre": 70
    }, {
        "date": "2012-07-29",
        "value": 76
    }, {
        "date": "2012-07-30",
        "value": 80
    }, {
        "date": "2012-07-31",
        "value": 95
    }, {
        "date": "2012-08-01",
        "value": 100
    }, {
        "date": "2012-08-02",
        "value": 124
    }, {
        "date": "2012-08-03",
        "value": 136
    }, {
        "date": "2012-08-04",
        "value": 136
    }, {
        "date": "2012-08-05",
        "value": 136
    }, {
        "date": "2012-08-06",
        "value": 158
    }, {
        "date": "2012-08-07",
        "value": 167
    }, {
        "date": "2012-08-08",
        "value": 169
    }, {
        "date": "2012-08-09",
        "value": 170
    }, {
        "date": "2012-08-10",
        "value": 186
    }, {
        "date": "2012-08-11",
        "value": 189
    }, {
        "date": "2012-08-12",
        "value": 190
    }, {
        "date": "2012-08-13",
        "value": 196
    }, {
        "date": "2012-08-14",
        "value": 199
    }, {
        "date": "2012-08-15",
        "value": 220
    }, {
        "date": "2012-08-16",
        "value": 236
    }, {
        "date": "2012-08-17",
        "value": 245
    }, {
        "date": "2012-08-18",
        "value": 256
    }, {
        "date": "2012-08-19",
        "value": 260
    }, {
        "date": "2012-08-20",
        "value": 270
    }, {
        "date": "2012-08-21",
        "value": 276
    }, {
        "date": "2012-08-22",
        "value": 276
    }, {
        "date": "2012-08-23",
        "value": 276
    }, {
        "date": "2012-08-24",
        "value": 276
    }, {
        "date": "2012-08-25",
        "value": 280
    }, {
        "date": "2012-08-26",
        "value": 289
    }, {
        "date": "2012-08-27",
        "value": 295
    }, {
        "date": "2012-08-28",
        "value": 305
    }, {
        "date": "2012-08-29",
        "value": 309
    }, {
        "date": "2012-08-30",
        "value": 316
    }, {
        "date": "2012-08-31",
        "value": 321
    }, {
        "date": "2012-09-01",
        "value": 333
    }, {
        "date": "2012-09-02",
        "value": 340
    }, {
        "date": "2012-09-03",
        "value": 346
    }, {
        "date": "2012-09-04",
        "value": 346
    }, {
        "date": "2012-09-05",
        "value": 350
    }, {
        "date": "2012-09-06",
        "value": 356
    }, {
        "date": "2012-09-07",
        "value": 361
    }, {
        "date": "2012-09-08",
        "value": 370
    }, {
        "date": "2012-09-09",
        "value": 375
    }, {
        "date": "2012-09-10",
        "value": 380
    }, {
        "date": "2012-09-11",
        "value": 390
    }, {
        "date": "2012-09-12",
        "value": 398
    }, {
        "date": "2012-09-13",
        "value": 405
    }, {
        "date": "2012-09-14",
        "value": 435
    }, {
        "date": "2012-09-15",
        "value": 436
    }, {
        "date": "2012-09-16",
        "value": 475
    }, {
        "date": "2012-09-17",
        "value": 486
    }, {
        "date": "2012-09-18",
        "value": 499
    }, {
        "date": "2012-09-19",
        "value": 515
    }, {
        "date": "2012-09-20",
        "value": 526
    }, {
        "date": "2012-09-21",
        "value": 535
    }, {
        "date": "2012-09-22",
        "value": 545
    }, {
        "date": "2012-09-23",
        "value": 565
    }, {
        "date": "2012-09-24",
        "value": 570
    }, {
        "date": "2012-09-25",
        "value": 570
    }, {
        "date": "2012-09-26",
        "value": 570
    }, {
        "date": "2012-09-27",
        "value": 586
    }, {
        "date": "2012-09-28",
        "value": 590
    }, {
        "date": "2012-09-29",
        "value": 605
    }, {
        "date": "2012-09-30",
        "value": 603
    }, {
        "date": "2012-10-01",
        "value": 615
    }, {
        "date": "2012-10-02",
        "value": 620
    }, {
        "date": "2012-10-03",
        "value": 635
    }, {
        "date": "2012-10-04",
        "value": 640
    }, {
        "date": "2012-10-05",
        "value": 658
    }, {
        "date": "2012-10-06",
        "value": 659
    }, {
        "date": "2012-10-07",
        "value": 668
    }, {
        "date": "2012-10-08",
        "value": 689
    }, {
        "date": "2012-10-09",
        "value": 702
    }, {
        "date": "2012-10-10",
        "value": 715
    }, {
        "date": "2012-10-11",
        "value": 715
    }, {
        "date": "2012-10-12",
        "value": 715
    }, {
        "date": "2012-10-13",
        "value": 715
    }, {
        "date": "2012-10-14",
        "value": 715
    }, {
        "date": "2012-10-15",
        "value": 728
    }, {
        "date": "2012-10-16",
        "value": 738
    }, {
        "date": "2012-10-17",
        "value": 746
    }, {
        "date": "2012-10-18",
        "value": 752
    }, {
        "date": "2012-10-19",
        "value": 763
    }, {
        "date": "2012-10-20",
        "value": 782
    }, {
        "date": "2012-10-21",
        "value": 776
    }, {
        "date": "2012-10-22",
        "value": 789
    }, {
        "date": "2012-10-23",
        "value": 796
    }, {
        "date": "2012-10-24",
        "value": 803
    }, {
        "date": "2012-10-25",
        "value": 825
    }, {
        "date": "2012-10-26",
        "value": 836
    }, {
        "date": "2012-10-27",
        "value": 846
    }, {
        "date": "2012-10-28",
        "value": 859
    }, {
        "date": "2012-10-29",
        "value": 879
    }, {
        "date": "2012-10-30",
        "value": 911
    }, {
        "date": "2012-10-31",
        "value": 935
    }, {
        "date": "2012-11-01",
        "value": 946
    }, {
        "date": "2012-11-02",
        "value": 958
    }, {
        "date": "2012-11-03",
        "value": 968
    }, {
        "date": "2012-11-04",
        "value": 976
    }, {
        "date": "2012-11-05",
        "value": 986
    }, {
        "date": "2012-11-06",
        "value": 990
    }, {
        "date": "2012-11-07",
        "value": 1104
    }, {
        "date": "2012-11-08",
        "value": 1133
    }, {
        "date": "2012-11-09",
        "value": 1136
    }, {
        "date": "2012-11-10",
        "value": 1136
    }, {
        "date": "2012-11-11",
        "value": 1136
    }, {
        "date": "2012-11-12",
        "value": 1136
    }, {
        "date": "2012-11-13",
        "value": 1136
    }, {
        "date": "2012-11-14",
        "value": 1136
    }, {
        "date": "2012-11-15",
        "value": 1144
    }, {
        "date": "2012-11-16",
        "value": 1168
    }, {
        "date": "2012-11-17",
        "value": 1179
    }, {
        "date": "2012-11-18",
        "value": 1186
    }, {
        "date": "2012-11-19",
        "value": 1195
    }, {
        "date": "2012-11-20",
        "value": 1213
    }, {
        "date": "2012-11-21",
        "value": 1226
    }, {
        "date": "2012-11-22",
        "value": 1235
    }, {
        "date": "2012-11-23",
        "value": 1245
    }, {
        "date": "2012-11-24",
        "value": 1256
    }, {
        "date": "2012-11-25",
        "value": 1270
    }, {
        "date": "2012-11-26",
        "value": 1276
    }, {
        "date": "2012-11-27",
        "value": 1280
    }, {
        "date": "2012-11-28",
        "value": 1286
    }, {
        "date": "2012-11-29",
        "value": 1312
    }, {
        "date": "2012-11-30",
        "value": 1325
    }, {
        "date": "2012-12-01",
        "value": 1330
    }, {
        "date": "2012-12-02",
        "value": 1336
    }, {
        "date": "2012-12-03",
        "value": 1340
    }, {
        "date": "2012-12-04",
        "value": 1348
    }, {
        "date": "2012-12-05",
        "value": 1356
    }, {
        "date": "2012-12-06",
        "value": 1364
    }, {
        "date": "2012-12-07",
        "value": 1369
    }, {
        "date": "2012-12-08",
        "value": 1374
    }, {
        "date": "2012-12-09",
        "value": 1382
    }, {
        "date": "2012-12-10",
        "value": 1395
    }, {
        "date": "2012-12-11",
        "value": 1405
    }, {
        "date": "2012-12-12",
        "value": 1415
    }, {
        "date": "2012-12-13",
        "value": 1425
    }, {
        "date": "2012-12-14",
        "value": 1433
    }, {
        "date": "2012-12-15",
        "value": 1450
    }, {
        "date": "2012-12-16",
        "value": 1472
    }, {
        "date": "2012-12-17",
        "value": 1480
    }, {
        "date": "2012-12-18",
        "value": 1486
    }, {
        "date": "2012-12-19",
        "value": 1490
    }, {
        "date": "2012-12-20",
        "value": 1497
    }, {
        "date": "2012-12-21",
        "value": 1511
    }, {
        "date": "2012-12-22",
        "value": 1515
    }, {
        "date": "2012-12-23",
        "value": 1520
    }, {
        "date": "2012-12-24",
        "value": 1526
    }, {
        "date": "2012-12-25",
        "value": 1530
    }, {
        "date": "2012-12-26",
        "value": 1532
    }, {
        "date": "2012-12-27",
        "value": 1536
    }, {
        "date": "2012-12-28",
        "value": 1542
    }, {
        "date": "2012-12-29",
        "value": 1548
    }, {
        "date": "2012-12-30",
        "value": 1551
    }, {
        "date": "2012-12-31",
        "value": 1554
    }, {
        "date": "2013-01-01",
        "value": 1557
    }, {
        "date": "2013-01-02",
        "value": 1560
    }, {
        "date": "2013-01-03",
        "value": 1562
    }, {
        "date": "2013-01-04",
        "value": 1563
    }, {
        "date": "2013-01-05",
        "value": 1568
    }, {
        "date": "2013-01-06",
        "value": 1569
    }, {
        "date": "2013-01-07",
        "value": 1571
    }, {
        "date": "2013-01-08",
        "value": 1573
    }, {
        "date": "2013-01-09",
        "value": 1578
    }, {
        "date": "2013-01-10",
        "value": 1579
    }, {
        "date": "2013-01-11",
        "value": 1581
    }, {
        "date": "2013-01-12",
        "value": 1583
    }, {
        "date": "2013-01-13",
        "value": 1586
    }, {
        "date": "2013-01-14",
        "value": 1594
    }, {
        "date": "2013-01-15",
        "value": 1602
    }, {
        "date": "2013-01-16",
        "value": 1603
    }, {
        "date": "2013-01-17",
        "value": 1603
    }, {
        "date": "2013-01-18",
        "value": 1603
    }, {
        "date": "2013-01-19",
        "value": 1603
    }, {
        "date": "2013-01-20",
        "value": 1603
    }, {
        "date": "2013-01-21",
        "value": 1611
    }, {
        "date": "2013-01-22",
        "value": 1620
    }, {
        "date": "2013-01-23",
        "value": 1629
    }, {
        "date": "2013-01-24",
        "value": 1635
    }, {
        "date": "2013-01-25",
        "value": 1640
    }, {
        "date": "2013-01-26",
        "value": 1645
    }, {
        "date": "2013-01-27",
        "value": 1649
    }, {
        "date": "2013-01-28",
        "value": 1651
    }, {
        "date": "2013-01-29",
        "value": 1658
    }, {
        "date": "2013-01-30",
        "value": 1669
    }];

var chart20;

var chart21;

var chart22;
var chart23;
var chart24;
var chart25;
var chart26;
var chart27;

AmCharts.ready(function () {

    chart = AmCharts.makeChart( "chartLocation", {
      "type": "pie",
      "dataProvider": chartData,
      "valueField": "value",
      "titleField": "country",
       "balloon":{
       "fixedPosition":true
      }
    });

//----------------------------------------------------------------------------------------------------

    chart2 =  AmCharts.makeChart( "chartPrix", {
        "type": "funnel",
        "theme": "light",
        "dataProvider": chartData2,
        "balloon": {
          "fixedPosition": true
        },
        "valueField": "nombre",
        "titleField": "prix",
        "marginRight": 240,
        "marginLeft": 50,
        "startX": -500,
        "rotate": true,
        "labelPosition": "right",
        "balloonText": "[[prix]]: [[nombre]]",
      }
    );


    //---------------------------------------------------------------------------------------------

    chart3 = AmCharts.makeChart("chartTypeProduit", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": chartData3,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type]]: [[nombre]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "nombre"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      },
      "export": {
        "enabled": true
      }
    });


    //---------------------------------------------------------------------------------------------


    chart4 = AmCharts.makeChart("chartTypeVendeur", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": chartData4,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type]]: [[nombre]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "nombre"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      }
    });

    //----------------------------------------------------------------------------------

    chart5 = AmCharts.makeChart("chartClientPays", {
      "type": "serial",
      "marginRight": 70,
      "dataProvider": chartData5,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombre de clients enregistrés "
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[category]]: [[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "country",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      }
    });

    //-------------------------------------------------------------------------------------------

    chart6 = AmCharts.makeChart("chartClientDate", {
        "type": "serial",
        "theme": "light",
        "marginRight": 40,
        "marginLeft": 40,
        "autoMarginOffset": 20,
        "mouseWheelZoomEnabled":true,
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id": "v1",
            "axisAlpha": 0,
            "position": "left",
            "ignoreAxisWidth":true
        }],
        "balloon": {
            "borderThickness": 1,
            "shadowAlpha": 0
        },
        "graphs": [{
            "id": "g1",
            "balloon":{
              "drop":true,
              "adjustBorderColor":false,
              "color":"#ffffff"
            },
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "value",
            "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
        }],
        "chartScrollbar": {
            "graph": "g1",
            "oppositeAxis":false,
            "offset":30,
            "scrollbarHeight": 80,
            "backgroundAlpha": 0,
            "selectedBackgroundAlpha": 0.1,
            "selectedBackgroundColor": "#888888",
            "graphFillAlpha": 0,
            "graphLineAlpha": 0.5,
            "selectedGraphFillAlpha": 0,
            "selectedGraphLineAlpha": 1,
            "autoGridCount":true,
            "color":"#AAAAAA"
        },
        "chartCursor": {
            "pan": true,
            "valueLineEnabled": true,
            "valueLineBalloonEnabled": true,
            "cursorAlpha":1,
            "cursorColor":"#258cbb",
            "limitToGraph":"g1",
            "valueLineAlpha":0.2,
            "valueZoomable":true
        },
        "valueScrollbar":{
          "oppositeAxis":false,
          "offset":50,
          "scrollbarHeight":10
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true
        },
        "export": {
            "enabled": true
        },
        "dataProvider" : chartData6
      });

  chart6.addListener("rendered", zoomChart);
  zoomChart();
  function zoomChart() {
      chart6.zoomToIndexes(chart6.dataProvider.length - 40, chart6.dataProvider.length - 1);
  }

  //------------------------------------------------------------------------------------------------

  chart7 = AmCharts.makeChart("chartClientAcheteurPays", {
      "type": "serial",
      "marginRight": 70,
      "dataProvider": chartData7,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombre de client acheteur"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[category]]: [[value]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "visits"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "country",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      }
    });

//------------------------------------------------------------------------------------------

chart8 = AmCharts.makeChart("chartClientAcheteurDate", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataProvider" : chartData8
  });

chart8.addListener("rendered", zoomChart);
zoomChart2();
function zoomChart2() {
  chart8.zoomToIndexes(chart6.dataProvider.length - 40, chart6.dataProvider.length - 1);
}

//-------------------------------------------------------------------------------------------

chart9 =  AmCharts.makeChart("chartClientAcheteurTypeBien", {
    "type": "serial",
    "theme": "light",
    "marginRight": 70,
    "dataProvider": chartData9,
    "valueAxes": [{
      "axisAlpha": 0,
      "position": "left",
      "title": "Nombres de produits"
    }],
    "startDuration": 1,
    "graphs": [{
      "balloonText": "<b>[[type]]: [[nombre]]</b>",
      "fillColorsField": "color",
      "fillAlphas": 0.9,
      "lineAlpha": 0.2,
      "type": "column",
      "valueField": "nombre"
    }],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false
    },
    "categoryField": "type",
    "categoryAxis": {
      "gridPosition": "start",
      "labelRotation": 45
    },
    "export": {
      "enabled": true
    }
  });

//-----------------------------------------------------------------------------------------------

chart10 = AmCharts.makeChart( "chartClientAcheteurLocalisationBien", {
  "type": "pie",
  "dataProvider": chartData10,
  "valueField": "litres",
  "titleField": "country",
   "balloon":{
   "fixedPosition":true
  }
});

//---------------------------------------------------------------------------------------------

chart11 = AmCharts.makeChart( "chartClientAcheteurMontantAchat", {
  "type": "funnel",
  "theme": "light",
  "dataProvider": chartData11,
  "titleField": "title",
  "marginRight": 160,
  "marginLeft": 15,
  "labelPosition": "right",
  "funnelAlpha": 0.9,
  "valueField": "value",
  "startX": 0,
  "neckWidth": "40%",
  "startAlpha": 0,
  "outlineThickness": 1,
  "neckHeight": "30%",
  "balloonText": "[[title]]:<b>[[value]]</b>",
  "export": {
    "enabled": true
  }
});

//-------------------------------------------------------------------------------------------

chart12 =  AmCharts.makeChart("chartAFAEtat", {
  "type": "serial",
  "marginRight": 70,
  "dataProvider": chartData12,
  "valueAxes": [{
      "axisAlpha": 0,
      "position": "left",
      "title": "Nombres d'agence francophone australienne"
    }],
    "startDuration": 1,
    "graphs": [{
      "balloonText": "<b>[[etat]]: [[nombre]]</b>",
      "fillColorsField": "color",
      "fillAlphas": 0.9,
      "lineAlpha": 0.2,
      "type": "column",
      "valueField": "nombre"
    }],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false
    },
    "categoryField": "etat",
    "categoryAxis": {
      "gridPosition": "start",
      "labelRotation": 45
    }
  });

  //------------------------------------------------------------------------

  chart13 =  AmCharts.makeChart("chartAFADate", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataProvider": chartData13
  });

  chart13.addListener("rendered", zoomChart);

  zoomChart13();

  function zoomChart13() {
      chart13.zoomToIndexes(chart13.dataProvider.length - 40, chart13.dataProvider.length - 1);
  }

  //-----------------------------------------------------------------------------------------------

  chart14 = AmCharts.makeChart( "chartAFAChiffreAffaire", {
    "type": "pie",
    "theme": "light",
    "dataProvider": chartData14,
    "valueField": "valeur",
    "titleField": "prix",
     "balloon":{
       "fixedPosition":true
      }
  });

  //------------------------------------------------------------------------------------------------

  chart15 = AmCharts.makeChart( "chartAPLPays", {
    "type": "serial",
    "dataProvider": chartData15,
    "gridAboveGraphs": true,
    "startDuration": 1,
    "graphs": [ {
      "balloonText": "[[category]]: <b>[[value]]</b>",
      "fillAlphas": 0.8,
      "lineAlpha": 0.2,
      "type": "column",
      "valueField": "visits"
    } ],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
      "gridPosition": "start",
      "labelRotation": 45,
      "gridAlpha": 0,
      "tickPosition": "start",
      "tickLength": 20
    }
  });

  //--------------------------------------------------------------------------------

  char16 = AmCharts.makeChart("chartAPLDateAdhesion", {
      "type": "serial",
      "theme": "light",
      "marginRight": 40,
      "marginLeft": 40,
      "autoMarginOffset": 20,
      "mouseWheelZoomEnabled":true,
      "dataDateFormat": "YYYY-MM-DD",
      "valueAxes": [{
          "id": "v1",
          "axisAlpha": 0,
          "position": "left",
          "ignoreAxisWidth":true
      }],
      "balloon": {
          "borderThickness": 1,
          "shadowAlpha": 0
      },
      "graphs": [{
          "id": "g1",
          "balloon":{
            "drop":true,
            "adjustBorderColor":false,
            "color":"#ffffff"
          },
          "bullet": "round",
          "bulletBorderAlpha": 1,
          "bulletColor": "#FFFFFF",
          "bulletSize": 5,
          "hideBulletsCount": 50,
          "lineThickness": 2,
          "title": "red line",
          "useLineColorForBulletBorder": true,
          "valueField": "value",
          "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
      }],
      "chartScrollbar": {
          "graph": "g1",
          "oppositeAxis":false,
          "offset":30,
          "scrollbarHeight": 80,
          "backgroundAlpha": 0,
          "selectedBackgroundAlpha": 0.1,
          "selectedBackgroundColor": "#888888",
          "graphFillAlpha": 0,
          "graphLineAlpha": 0.5,
          "selectedGraphFillAlpha": 0,
          "selectedGraphLineAlpha": 1,
          "autoGridCount":true,
          "color":"#AAAAAA"
      },
      "chartCursor": {
          "pan": true,
          "valueLineEnabled": true,
          "valueLineBalloonEnabled": true,
          "cursorAlpha":1,
          "cursorColor":"#258cbb",
          "limitToGraph":"g1",
          "valueLineAlpha":0.2,
          "valueZoomable":true
      },
      "valueScrollbar":{
        "oppositeAxis":false,
        "offset":50,
        "scrollbarHeight":10
      },
      "categoryField": "date",
      "categoryAxis": {
          "parseDates": true,
          "dashLength": 1,
          "minorGridEnabled": true
      },
      "export": {
          "enabled": true
      },
      "dataProvider" : chartData6
    });

  char16.addListener("rendered", zoomChart);
  zoomChart16();
  function zoomChart16() {
    char16.zoomToIndexes(char16.dataProvider.length - 40, char16.dataProvider.length - 1);
  }

  //-------------------------------------------------------------------------------------

  chart17 = AmCharts.makeChart( "chartAPLNombreBienVendus", {
    "type": "pie",
    "dataProvider": chartData17,
    "valueField": "value",
    "titleField": "country",
     "balloon":{
     "fixedPosition":true
    }
  });

  //------------------------------------------------------------------------------------


  chart18 = AmCharts.makeChart( "chartAPLChiffreAffaire", {
    "type": "pie",
    "dataProvider": chartData18,
    "valueField": "value",
    "titleField": "country",
     "balloon":{
     "fixedPosition":true
    }
  });

  //-------------------------------------------------------------------------------------

  chart19 = AmCharts.makeChart("chartClientCumule", {
    "type": "serial",
   "theme": "light",
   "marginRight": 80,
   "autoMarginOffset": 20,
   "marginTop": 7,
   "dataProvider": chartData19,
   "valueAxes": [{
         "axisAlpha": 0.2,
         "dashLength": 1,
         "position": "left"
     }],
     "mouseWheelZoomEnabled": true,
     "graphs": [{
         "id": "g1",
         "balloonText": "[[value]]",
         "bullet": "round",
         "bulletBorderAlpha": 1,
         "bulletColor": "#FFFFFF",
         "hideBulletsCount": 50,
         "title": "red line",
         "valueField": "value",
         "useLineColorForBulletBorder": true,
         "balloon":{
             "drop":true
         }
     }],
     "chartScrollbar": {
         "autoGridCount": true,
         "graph": "g1",
         "scrollbarHeight": 40
     },
     "chartCursor": {
        "limitToGraph":"g1"
     },
     "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
});

chart19.addListener("rendered", zoomChart19);
zoomChart19();

// this method is called when chart is first inited as we listen for "rendered" event
function zoomChart19() {
    // different zoom methods can be used - zoomToIndexes, zoomToDates, zoomToCategoryValues
    chart19.zoomToIndexes(chartData19.length - 40, chartData19.length - 1);
}

//---------------------------------------------------------------------------------------------------------


chart20 = AmCharts.makeChart("chartClientAcheteurCumule", {
  "type": "serial",
 "theme": "light",
 "marginRight": 80,
 "autoMarginOffset": 20,
 "marginTop": 7,
 "dataProvider": chartData19,
 "valueAxes": [{
       "axisAlpha": 0.2,
       "dashLength": 1,
       "position": "left"
   }],
   "mouseWheelZoomEnabled": true,
   "graphs": [{
       "id": "g1",
       "balloonText": "[[value]]",
       "bullet": "round",
       "bulletBorderAlpha": 1,
       "bulletColor": "#FFFFFF",
       "hideBulletsCount": 50,
       "title": "red line",
       "valueField": "value",
       "useLineColorForBulletBorder": true,
       "balloon":{
           "drop":true
       }
   }],
   "chartScrollbar": {
       "autoGridCount": true,
       "graph": "g1",
       "scrollbarHeight": 40
   },
   "chartCursor": {
      "limitToGraph":"g1"
   },
   "categoryField": "date",
  "categoryAxis": {
      "parseDates": true,
      "axisColor": "#DADADA",
      "dashLength": 1,
      "minorGridEnabled": true
  },
});

chart20.addListener("rendered", zoomChart20);
zoomChart20();
function zoomChart20() {
    chart20.zoomToIndexes(chartData19.length - 40, chartData19.length - 1);
}

//-------------------------------------------------------------------------------------------------------------------

chart21 =  AmCharts.makeChart("chartTransactionPays", {
    "type": "serial",
    "marginRight": 70,
    "dataProvider": chartData7,
    "valueAxes": [{
      "axisAlpha": 0,
      "position": "left",
      "title": "Nombre de client acheteur"
    }],
    "startDuration": 1,
    "graphs": [{
      "balloonText": "<b>[[category]]: [[value]]</b>",
      "fillColorsField": "color",
      "fillAlphas": 0.9,
      "lineAlpha": 0.2,
      "type": "column",
      "valueField": "visits"
    }],
    "chartCursor": {
      "categoryBalloonEnabled": false,
      "cursorAlpha": 0,
      "zoomable": false
    },
    "categoryField": "country",
    "categoryAxis": {
      "gridPosition": "start",
      "labelRotation": 45
    }
  });



//-------------------------------------------------------------------------------------------------------------------

  chart22 = AmCharts.makeChart("chartTransactionDate", {
      "type": "serial",
      "theme": "light",
      "marginRight": 40,
      "marginLeft": 40,
      "autoMarginOffset": 20,
      "mouseWheelZoomEnabled":true,
      "dataDateFormat": "YYYY-MM-DD",
      "valueAxes": [{
          "id": "v1",
          "axisAlpha": 0,
          "position": "left",
          "ignoreAxisWidth":true
      }],
      "balloon": {
          "borderThickness": 1,
          "shadowAlpha": 0
      },
      "graphs": [{
          "id": "g1",
          "balloon":{
            "drop":true,
            "adjustBorderColor":false,
            "color":"#ffffff"
          },
          "bullet": "round",
          "bulletBorderAlpha": 1,
          "bulletColor": "#FFFFFF",
          "bulletSize": 5,
          "hideBulletsCount": 50,
          "lineThickness": 2,
          "title": "red line",
          "useLineColorForBulletBorder": true,
          "valueField": "value",
          "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
      }],
      "chartScrollbar": {
          "graph": "g1",
          "oppositeAxis":false,
          "offset":30,
          "scrollbarHeight": 80,
          "backgroundAlpha": 0,
          "selectedBackgroundAlpha": 0.1,
          "selectedBackgroundColor": "#888888",
          "graphFillAlpha": 0,
          "graphLineAlpha": 0.5,
          "selectedGraphFillAlpha": 0,
          "selectedGraphLineAlpha": 1,
          "autoGridCount":true,
          "color":"#AAAAAA"
      },
      "chartCursor": {
          "pan": true,
          "valueLineEnabled": true,
          "valueLineBalloonEnabled": true,
          "cursorAlpha":1,
          "cursorColor":"#258cbb",
          "limitToGraph":"g1",
          "valueLineAlpha":0.2,
          "valueZoomable":true
      },
      "valueScrollbar":{
        "oppositeAxis":false,
        "offset":50,
        "scrollbarHeight":10
      },
      "categoryField": "date",
      "categoryAxis": {
          "parseDates": true,
          "dashLength": 1,
          "minorGridEnabled": true
      },
      "export": {
          "enabled": true
      },
      "dataProvider" : chartData8
    });

  chart22.addListener("rendered", zoomChart);

  //-------------------------------------------------------------------------------------------------------------------


  chart23 = AmCharts.makeChart("chartTransactionCumule", {
    "type": "serial",
   "theme": "light",
   "marginRight": 80,
   "autoMarginOffset": 20,
   "marginTop": 7,
   "dataProvider": chartData19,
   "valueAxes": [{
         "axisAlpha": 0.2,
         "dashLength": 1,
         "position": "left"
     }],
     "mouseWheelZoomEnabled": true,
     "graphs": [{
         "id": "g1",
         "balloonText": "[[value]]",
         "bullet": "round",
         "bulletBorderAlpha": 1,
         "bulletColor": "#FFFFFF",
         "hideBulletsCount": 50,
         "title": "red line",
         "valueField": "value",
         "useLineColorForBulletBorder": true,
         "balloon":{
             "drop":true
         }
     }],
     "chartScrollbar": {
         "autoGridCount": true,
         "graph": "g1",
         "scrollbarHeight": 40
     },
     "chartCursor": {
        "limitToGraph":"g1"
     },
     "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
  });

  chart23.addListener("rendered", zoomChart);

  //-------------------------------------------------------------------------------------------------------------------

  chart24 =  AmCharts.makeChart("chartTransactionTypeBien", {
      "type": "serial",
      "theme": "light",
      "marginRight": 70,
      "dataProvider": chartData9,
      "valueAxes": [{
        "axisAlpha": 0,
        "position": "left",
        "title": "Nombres de produits"
      }],
      "startDuration": 1,
      "graphs": [{
        "balloonText": "<b>[[type]]: [[nombre]]</b>",
        "fillColorsField": "color",
        "fillAlphas": 0.9,
        "lineAlpha": 0.2,
        "type": "column",
        "valueField": "nombre"
      }],
      "chartCursor": {
        "categoryBalloonEnabled": false,
        "cursorAlpha": 0,
        "zoomable": false
      },
      "categoryField": "type",
      "categoryAxis": {
        "gridPosition": "start",
        "labelRotation": 45
      },
      "export": {
        "enabled": true
      }
    });

  //-------------------------------------------------------------------------------------------------------------------

  chart25 = AmCharts.makeChart( "chartTransactionMontantAchat", {
      "type": "funnel",
      "theme": "light",
      "dataProvider": chartData2,
      "balloon": {
        "fixedPosition": true
      },
      "valueField": "nombre",
      "titleField": "prix",
      "marginRight": 240,
      "marginLeft": 50,
      "startX": -500,
      "rotate": true,
      "labelPosition": "right",
      "balloonText": "[[prix]]: [[nombre]]",
    }
  );

//-------------------------------------------------------------------------------------------------------------------

  chart26 = AmCharts.makeChart("chartAFACumule", {
    "type": "serial",
   "theme": "light",
   "marginRight": 80,
   "autoMarginOffset": 20,
   "marginTop": 7,
   "dataProvider": chartData19,
   "valueAxes": [{
         "axisAlpha": 0.2,
         "dashLength": 1,
         "position": "left"
     }],
     "mouseWheelZoomEnabled": true,
     "graphs": [{
         "id": "g1",
         "balloonText": "[[value]]",
         "bullet": "round",
         "bulletBorderAlpha": 1,
         "bulletColor": "#FFFFFF",
         "hideBulletsCount": 50,
         "title": "red line",
         "valueField": "value",
         "useLineColorForBulletBorder": true,
         "balloon":{
             "drop":true
         }
     }],
     "chartScrollbar": {
         "autoGridCount": true,
         "graph": "g1",
         "scrollbarHeight": 40
     },
     "chartCursor": {
        "limitToGraph":"g1"
     },
     "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
  });

  chart26.addListener("rendered", zoomChart);

//-------------------------------------------------------------------------------------------------------------------

  chart27 = AmCharts.makeChart("chartAPLCumule", {
    "type": "serial",
   "theme": "light",
   "marginRight": 80,
   "autoMarginOffset": 20,
   "marginTop": 7,
   "dataProvider": chartData19,
   "valueAxes": [{
         "axisAlpha": 0.2,
         "dashLength": 1,
         "position": "left"
     }],
     "mouseWheelZoomEnabled": true,
     "graphs": [{
         "id": "g1",
         "balloonText": "[[value]]",
         "bullet": "round",
         "bulletBorderAlpha": 1,
         "bulletColor": "#FFFFFF",
         "hideBulletsCount": 50,
         "title": "red line",
         "valueField": "value",
         "useLineColorForBulletBorder": true,
         "balloon":{
             "drop":true
         }
     }],
     "chartScrollbar": {
         "autoGridCount": true,
         "graph": "g1",
         "scrollbarHeight": 40
     },
     "chartCursor": {
        "limitToGraph":"g1"
     },
     "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
  });

  chart27.addListener("rendered", zoomChart);

});
