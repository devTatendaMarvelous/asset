class ApiConfig {
  static const String baseUrl = 'http://213.199.61.187:9030/api';

  static const String loginEndpoint = '/login';
  static const String scanAssetEndpoint = '/assets/details';
  static const String clockAssetEndpoint = '/assets/cloak';

  // Timeout durations
  static const Duration connectionTimeout = Duration(seconds: 30);
  static const Duration receiveTimeout = Duration(seconds: 30);
}