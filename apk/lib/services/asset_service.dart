import 'package:dio/dio.dart';

import '../config/api_config.dart';
import '../models/scan_response.dart';
import '../models/clock_response.dart';
import 'api_service.dart';

class AssetService {
  final ApiService _apiService = ApiService();

  // Scan asset
  Future<ScanResponse> scanAsset(String code) async {
    try {
      final response = await _apiService.get(
        ApiConfig.scanAssetEndpoint,
        queryParameters: {
          'code': code,
        },
      );

      return ScanResponse.fromJson(response.data);
    } catch (e) {
      throw Exception('Scan failed: ${e.toString()}');
    }
  }

  // Clock in/out asset
  Future<ClockResponse> clockAsset({
    required int assetId,
    required String action, // 'IN' or 'OUT'
  }) async {
    try {
      final response = await _apiService.post(
        ApiConfig.clockAssetEndpoint,
        data: {
          'asset_id': assetId,
          'action': action,
        },
      );

      return ClockResponse.fromJson(response.data);
    } catch (e) {
      throw Exception('Clock action failed: ${e.toString()}');
    }
  }


  Future<void> reportFound({
    required int assetId,
    required String notes,
  }) async {
    try {
      final  response = await _apiService.post(
        '/assets/found',
        data: {
          'asset_id': assetId,
          'notes': notes,
        },
      );

      // Accept 200 or 201 and status == success in body
      if (response.statusCode == 200 || response.statusCode == 201) {
        final data = response.data;
        final status = data != null && data['status'] != null ? data['status'] : null;
        if (status != null && status.toString().toLowerCase() == 'success') {
          return;
        } else {
          final message = data != null && data['message'] != null ? data['message'] : 'Unexpected server response';
          throw Exception(message);
        }
      } else {
        throw Exception('Failed to report asset found (status ${response.statusCode}).');
      }
    } on DioException catch (e) {
      // Re-throw with message from ApiService handler if available
      throw Exception(e.message ?? 'Network error while reporting found asset.');
    } catch (e) {
      throw Exception('Report found failed: ${e.toString()}');
    }
  }
}