class ScanResponse {
  final String status;
  final String message;
  final AssetData? data;

  ScanResponse({
    required this.status,
    required this.message,
    this.data,
  });

  bool get success => status.toLowerCase() == 'success';

  factory ScanResponse.fromJson(Map<String, dynamic> json) {
    return ScanResponse(
      status: json['status'] ?? '',
      message: json['message'] ?? '',
      data: json['data'] != null ? AssetData.fromJson(json['data']) : null,
    );
  }
}

class AssetData {
  final int id;
  final int userId;
  final int typeId;
  final String brand;
  final String serialNumber;
  final String description;
  final String status;
  final String createdAt;
  final String updatedAt;
  final UserData? user;
  final AssetType? type;

  AssetData({
    required this.id,
    required this.userId,
    required this.typeId,
    required this.brand,
    required this.serialNumber,
    required this.description,
    required this.status,
    required this.createdAt,
    required this.updatedAt,
    this.user,
    this.type,
  });

  factory AssetData.fromJson(Map<String, dynamic> json) {
    return AssetData(
      id: json['id'] ?? 0,
      userId: json['user_id'] ?? 0,
      typeId: json['type_id'] ?? 0,
      brand: json['brand'] ?? '',
      serialNumber: json['serial_number'] ?? '',
      description: json['description'] ?? '',
      status: json['status'] ?? '',
      createdAt: json['created_at'] ?? '',
      updatedAt: json['updated_at'] ?? '',
      user: json['user'] != null ? UserData.fromJson(json['user']) : null,
      type: json['type'] != null ? AssetType.fromJson(json['type']) : null,
    );
  }
}

class UserData {
  final int id;
  final String regNumber;
  final String name;
  final String email;
  final String? phone;
  final String createdAt;
  final String updatedAt;

  UserData({
    required this.id,
    required this.regNumber,
    required this.name,
    required this.email,
    this.phone,
    required this.createdAt,
    required this.updatedAt,
  });

  factory UserData.fromJson(Map<String, dynamic> json) {
    return UserData(
      id: json['id'] ?? 0,
      regNumber: json['reg_number'] ?? '',
      name: json['name'] ?? '',
      email: json['email'] ?? '',
      phone: json['phone'],
      createdAt: json['created_at'] ?? '',
      updatedAt: json['updated_at'] ?? '',
    );
  }
}

class AssetType {
  final int id;
  final String name;
  final String description;
  final String createdAt;
  final String updatedAt;

  AssetType({
    required this.id,
    required this.name,
    required this.description,
    required this.createdAt,
    required this.updatedAt,
  });

  factory AssetType.fromJson(Map<String, dynamic> json) {
    return AssetType(
      id: json['id'] ?? 0,
      name: json['name'] ?? '',
      description: json['description'] ?? '',
      createdAt: json['created_at'] ?? '',
      updatedAt: json['updated_at'] ?? '',
    );
  }
}