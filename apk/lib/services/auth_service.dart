import '../config/api_config.dart';
import '../models/login_response.dart';
import 'api_service.dart';
import 'storage_service.dart';

class AuthService {
  final ApiService _apiService = ApiService();
  final StorageService _storageService = StorageService();


  Future<LoginResponse> login(String email, String password) async {
    try {
      final response = await _apiService.post(
        ApiConfig.loginEndpoint,
        data: {
          'email': email,
          'password': password,
        },
      );

      final loginResponse = LoginResponse.fromJson(response.data);

      // Save token
      await _storageService.saveToken(
        loginResponse.accessToken,
        loginResponse.tokenType,
        loginResponse.expiresIn,
      );

      return loginResponse;
    } catch (e) {
      throw Exception('Login failed: ${e.toString()}');
    }
  }

  // Logout
  Future<void> logout() async {
    await _storageService.clearAll();
  }

  // Check if user is logged in
  bool isLoggedIn() {
    return _storageService.isTokenValid();
  }
}