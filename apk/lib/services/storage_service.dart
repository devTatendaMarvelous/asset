import 'package:get_storage/get_storage.dart';

class StorageService {
  static final StorageService _instance = StorageService._internal();
  factory StorageService() => _instance;
  StorageService._internal();

  final _storage = GetStorage();

  // Keys
  static const String _tokenKey = 'access_token';
  static const String _tokenTypeKey = 'token_type';
  static const String _expiresInKey = 'expires_in';
  static const String _loginTimeKey = 'login_time';
  static const String _userNameKey = 'user_name';
  static const String _userEmailKey = 'user_email';

  // Save token
  Future<void> saveToken(String token, String tokenType, int expiresIn) async {
    await _storage.write(_tokenKey, token);
    await _storage.write(_tokenTypeKey, tokenType);
    await _storage.write(_expiresInKey, expiresIn);
    await _storage.write(_loginTimeKey, DateTime.now().millisecondsSinceEpoch);
  }

  // Save user info
  Future<void> saveUserInfo({String? name, String? email}) async {
    if (name != null) await _storage.write(_userNameKey, name);
    if (email != null) await _storage.write(_userEmailKey, email);
  }

  // Get user info
  String? getUserName() => _storage.read(_userNameKey);
  String? getUserEmail() => _storage.read(_userEmailKey);

  // Get token
  String? getToken() {
    return _storage.read(_tokenKey);
  }

  // Check if token is valid
  bool isTokenValid() {
    final token = _storage.read(_tokenKey);
    final loginTime = _storage.read(_loginTimeKey);
    final expiresIn = _storage.read(_expiresInKey);

    if (token == null || loginTime == null || expiresIn == null) {
      return false;
    }

    final now = DateTime.now().millisecondsSinceEpoch;
    final expiryTime = loginTime + (expiresIn * 1000);

    return now < expiryTime;
  }

  // Clear token
  Future<void> clearToken() async {
    await _storage.remove(_tokenKey);
    await _storage.remove(_tokenTypeKey);
    await _storage.remove(_expiresInKey);
    await _storage.remove(_loginTimeKey);
  }

  // Clear all data
  Future<void> clearAll() async {
    await _storage.erase();
  }
}